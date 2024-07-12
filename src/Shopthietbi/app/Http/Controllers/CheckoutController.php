<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests;
use Illuminate\Mail\Mailable;
use Carbon\Carbon;
use App\Customer;
use App\Brand;
use App\Category;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->where('accessory_status', 'Hiện')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $customer_id = Session::get('customer_id');
        $address = DB::table('tbl_address')
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'tbl_address.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'tbl_address.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.xaid', '=', 'tbl_address.xaid')
            ->join('tbl_customers', 'tbl_customers.address_id', '=', 'tbl_address.address_id')
            ->where('tbl_customers.customer_id', $customer_id)
            ->get();
        $shipping_fee = $this->shipping_fee();

        if (!$shipping_fee) {
            $shipping_fee = 100000;
        }
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $total_cart = 0;
        foreach ($cart_detail as $key => $v_cart_detail) {
            $total_cart += $v_cart_detail->product_quantity;
        }
        Session::put('total_cart', $total_cart);
        $order_code = $this->generateRandomString();
        return view('pages.checkout.checkout')
            ->with('order_code', $order_code)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand)
            ->with('shipping_fee', $shipping_fee)
            ->with('cart_detail', $cart_detail)
            ->with('address', $address);
    }
    public function shipping_fee()
    {
        $customer_id = Session::get('customer_id');
        $address = DB::table('tbl_address')
            ->join('tbl_customers', 'tbl_customers.address_id', '=', 'tbl_address.address_id')
            ->where('tbl_customers.customer_id', $customer_id)->get();
        foreach ($address as $key => $v_address) {
            $shipping_fee = DB::table('tbl_shipping_fee')
                ->where('matp', $v_address->matp)
                ->where('maqh', $v_address->maqh)
                ->where('xaid', $v_address->xaid)
                ->first();
            if ($shipping_fee) {
                return $shipping_fee->shipping_fee_price; // Trả về giá trị của phí vận chuyển
            }
        }
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function save_checkout(Request $request)
    {

        $data_shipping = array();
        $data_shipping['shipping_name'] = $request->shipping_name;
        $data_shipping['shipping_address'] = $request->shipping_address . ', ' . $request->ward . ', ' . $request->district . ', ' . $request->city;
        $data_shipping['shipping_phone'] = $request->shipping_phone;
        $data_shipping['shipping_note'] = $request->shipping_note;
        $data_shipping['customer_id'] = Session::get('customer_id');
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data_shipping);
        Session::put('shipping_id', $shipping_id);
        $data_payment = array();
        $data_payment['payment_method'] = $request->payment_option;
        $data_payment['payment_status'] = 'Thanh toán khi nhận hàng';
        $data_payment['payment_amount'] = 0;
        $payment_id = DB::table('tbl_payment')->insertGetId($data_payment);
        $order_quantity = 0;

        $value_order_cart_detail = DB::table('tbl_cart_detail')
            ->where('customer_id', Session::get('customer_id'))
            ->get();

        foreach ($value_order_cart_detail as $v_order) {
            $order_quantity += $v_order->product_quantity;

            $qty_old = DB::table('tbl_product')
                ->where('product_id', $v_order->product_id)
                ->first();

            if ($qty_old) {
                $new_qty = $qty_old->product_quantity - $v_order->product_quantity;
                DB::table('tbl_product')
                    ->where('product_id', $qty_old->product_id)
                    ->update(['product_quantity' => $new_qty]);
            }
        }


        $data_order = array();
        $data_order['customer_id'] = Session::get('customer_id');
        $data_order['shipping_id'] = $shipping_id;
        $data_order['payment_id'] = $payment_id;
        $data_order['order_name'] = $request->order_code;
        $data_order['order_quantity'] = $order_quantity;
        $data_order['order_total'] = Session::get('total') + Session::get('shipping_fee');
        $data_order['shipping_fee'] = Session::get('shipping_fee');
        $data_order['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($data_order);
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $total_cart = 0;
        foreach ($cart_detail as $key => $v_cart_detail) {
            $total_cart += $v_cart_detail->product_quantity;
        }
        Session::put('total_cart', $total_cart);
        foreach ($cart_detail as $v_content) {
            $data_order_detail = array();
            $data_order_detail['order_id'] = $order_id;  // Correctly adding order_id to the detail array
            $data_order_detail['product_id'] = $v_content->product_id;
            $data_order_detail['product_image'] = $v_content->product_image;
            $data_order_detail['product_name'] = $v_content->product_name;
            $data_order_detail['product_price'] = $v_content->product_price;
            $data_order_detail['product_quantity'] = $v_content->product_quantity;
            DB::table('tbl_order_detail')->insert($data_order_detail);  // Inserting the detail into the database
            DB::table('tbl_cart_detail')
                ->where('customer_id', Session::get('customer_id'))
                ->where('product_id', $v_content->product_id)->delete();
            $qty_sold = DB::table('tbl_product')->where('product_id', $v_content->product_id)->first();
            $quantity_sold = intval($qty_sold->quantity_sold) + $v_content->product_quantity;
            DB::table('tbl_product')->where('product_id', $v_content->product_id)->update(['quantity_sold' => $quantity_sold]);
        }

        Session::put('order_id', $order_id);


        $this->send_mail();
        Session::put('message', 'Đặt hàng thành công');
        return redirect('/history-order');
    }
    public function send_mail()
    {
        Session::put('total_cart', 0);
        $customer_name = Session::get('customer_name');
        $order_name = DB::table('tbl_order')->where('order_id', Session::get('order_id'))->first();
        $content = DB::table('tbl_order_detail')->where('order_id', Session::get('order_id'))->get();
        $data_order_detail = []; // Khởi tạo mảng trước vòng lặp
        foreach ($content as $v_content) {
            $data_order_detail[] = [ // Thêm dữ liệu vào mảng
                'product_id' => $v_content->product_id,
                'product_image' => $v_content->product_image,
                'product_name' => $v_content->product_name,
                'product_price' => $v_content->product_price,
                'product_quantity' => $v_content->product_quantity,
            ];
        }
        $data = compact('order_name', 'customer_name', 'data_order_detail'); // Biến $customer_name và $data_order_detail thành một mảng dữ liệu

        Mail::send('pages.send_mail', $data, function ($message) {
            $customer_email = Session::get('customer_email');
            $message->to($customer_email, 'Shop thiết bị')
                ->subject('Mail mua hàng thành công');
        });

        return redirect('succes'); 
    }
    public function vnpay_payment(Request $request)
    {
        $vnp_TmnCode = "NWK6ZW3C";
        $vnp_HashSecret = "CZ0LXWXJVBCWGP0904JHBYOTCCSYWI6J";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url("/vnpay-return");
        $vnp_TxnRef = $request->order_code;
        $vnp_OrderInfo = "Thanh toán VN Pay";
        $vnp_OrderType = "Billvnpay";
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Version" => "2.1.0"

        );
        $data_shipping = array();
        $data_shipping['shipping_name'] = $request->shipping_name;
        $data_shipping['shipping_address'] = $request->shipping_address . ', ' . $request->ward . ', ' . $request->district . ', ' . $request->city;
        $data_shipping['shipping_phone'] = $request->shipping_phone;
        $data_shipping['shipping_note'] = $request->shipping_note;
        $data_shipping['customer_id'] = Session::get('customer_id');

        Session::put('data_shipping', $data_shipping);

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        if ($request->has('redirect')) {
            return redirect($vnp_Url);
        } else {
            return response()->json($returnData);
        }
    }

    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = "CZ0LXWXJVBCWGP0904JHBYOTCCSYWI6J"; //Secret key
        $data_shipping = Session::get('data_shipping');
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            $order_code = $inputData['vnp_TxnRef'];
            $amount = $inputData['vnp_Amount'] / 100; // Vì số tiền VNPay trả về đã được nhân với 100
            $responseCode = $inputData['vnp_ResponseCode'];

            if ($responseCode == '00') {

                $shipping_id = DB::table('tbl_shipping')->insertGetId($data_shipping);

                $data_payment = array();
                $data_payment['payment_method'] = $inputData['vnp_OrderInfo'];
                $data_payment['payment_status'] = 'Đã thanh toán';
                $data_payment['payment_amount'] = $amount;
                $payment_id = DB::table('tbl_payment')->insertGetId($data_payment);
                $order_quantity = 0;
                $value_order_cart_detail = DB::table('tbl_cart_detail')
                    ->where('customer_id', Session::get('customer_id'))
                    ->get();

                foreach ($value_order_cart_detail as $v_order) {
                    // Cộng dồn số lượng sản phẩm từ giỏ hàng
                    $order_quantity += $v_order->product_quantity;

                    // Lấy số lượng sản phẩm hiện tại từ bảng sản phẩm
                    $qty_old = DB::table('tbl_product')
                        ->where('product_id', $v_order->product_id)
                        ->first();

                    if ($qty_old) {
                        // Tính số lượng sản phẩm mới sau khi trừ đi số lượng đã đặt
                        $new_qty = $qty_old->product_quantity - $v_order->product_quantity;
                        // Cập nhật số lượng sản phẩm mới vào bảng sản phẩm
                        DB::table('tbl_product')
                            ->where('product_id', $qty_old->product_id)
                            ->update(['product_quantity' => $new_qty]);
                    }
                }
                $data_order = array();
                $data_order['customer_id'] = Session::get('customer_id');
                $data_order['shipping_id'] = $shipping_id;
                $data_order['payment_id'] = $payment_id;
                $data_order['order_name'] = $order_code;
                $data_order['order_quantity'] = $order_quantity;
                $data_order['order_total'] = Session::get('total') + Session::get('shipping_fee');
                $data_order['shipping_fee'] = Session::get('shipping_fee');
                $data_order['order_status'] = 'Đang chờ xử lý';
                $order_id = DB::table('tbl_order')->insertGetId($data_order);
                $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
                $total_cart = 0;
                foreach ($cart_detail as $key => $v_cart_detail) {
                    $total_cart += $v_cart_detail->product_quantity;
                }
                Session::put('total_cart', $total_cart);
                foreach ($cart_detail as $v_content) {
                    $data_order_detail = array();
                    $data_order_detail['order_id'] = $order_id;  // Correctly adding order_id to the detail array
                    $data_order_detail['product_id'] = $v_content->product_id;
                    $data_order_detail['product_image'] = $v_content->product_image;
                    $data_order_detail['product_name'] = $v_content->product_name;
                    $data_order_detail['product_price'] = $v_content->product_price;
                    $data_order_detail['product_quantity'] = $v_content->product_quantity;
                    DB::table('tbl_order_detail')->insert($data_order_detail);  // Inserting the detail into the database
                    DB::table('tbl_cart_detail')
                        ->where('customer_id', Session::get('customer_id'))
                        ->where('product_id', $v_content->product_id)->delete();
                    $qty_sold = DB::table('tbl_product')->where('product_id', $v_content->product_id)->first();
                    $quantity_sold = intval($qty_sold->quantity_sold) + $v_content->product_quantity;
                    DB::table('tbl_product')->where('product_id', $v_content->product_id)->update(['quantity_sold' => $quantity_sold]);
                }

                Session::put('order_id', $order_id);
                $this->send_mail();
                Session::put('message', 'Thanh toán thành công');
                return redirect('/history-order')->with('success', 'Thanh toán thành công');
            } else {
                Session::put('message', 'Thanh toán thất bại');
                return redirect('/history-order')->with('error', 'Thanh toán thất bại');
            }
        } else {

            return redirect('/history-order')->with('error', 'Xác minh không thành công');
        }
    }


}
