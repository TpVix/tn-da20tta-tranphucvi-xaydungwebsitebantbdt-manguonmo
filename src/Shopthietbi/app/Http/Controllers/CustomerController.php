<?php

namespace App\Http\Controllers;

use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Login; //sử dụng model Login
use App\Customer;
use App\Brand;
use App\Category;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function address()
    {
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $customer_id = Session::get('customer_id');
        $all_address = DB::table('tbl_address')
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'tbl_address.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'tbl_address.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.xaid', '=', 'tbl_address.xaid')
            ->where('customer_id', $customer_id)->orderBy('address_id', 'desc')->get();

        return view('pages.customer.address')
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand)
            ->with('all_address', $all_address);


    }
    public function add_address()
    {
        $city = DB::table('tbl_tinhthanhpho')->orderBy('matp', 'ASC')->get();
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        return view('pages.customer.add_address')
            ->with('city', $city)
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand);
    }
    public function save_address(Request $request)
    {
        $data = array();
        $data['matp'] = $request->city;
        $data['maqh'] = $request->district;
        $data['xaid'] = $request->ward;
        $data['address_name'] = $request->address_name;
        $data['address_phone'] = $request->address_phone;
        $data['customer_id'] = Session::get('customer_id');

        $address_id = DB::table('tbl_address')->insertGetId($data);
        Session::put('address_id', $address_id);

        return Redirect::to('/dia-chi');

    }
    public function delete_address($address_id)
    {

        DB::table('tbl_address')->where('address_id', $address_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('/dia-chi');
    }
    public function choose_address($address_id)
    {
        $customer_id = Session::get('customer_id');
        Customer::where('customer_id', $customer_id)->update(['address_id' => $address_id]);
        Session::put('address_id', $address_id);
        Session::put('message', 'Chọn thành công');
        return Redirect::to('/dia-chi');
    }
    public function edit_address($address_id)
    {
        $city = DB::table('tbl_tinhthanhpho')->orderBy('matp', 'ASC')->get();
        $district = DB::table('tbl_quanhuyen')->orderBy('maqh', 'ASC')->get();
        $ward = DB::table('tbl_xaphuongthitran')->orderBy('xaid', 'ASC')->get();
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $edit_address = DB::table('tbl_address')->where('address_id', $address_id)->get();

        Session::put('address_id', $address_id);
        return view('pages.customer.edit_address')
            ->with('city', $city)
            ->with('district', $district)
            ->with('ward', $ward)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('cart_detail', $cart_detail)
            ->with('brand', $brand)
            ->with('edit_address', $edit_address);
    }
    public function update_address(Request $request, $address_id)
    {
        $data = array();
        $data['matp'] = $request->city;
        $data['maqh'] = $request->district;
        $data['xaid'] = $request->ward;
        $data['address_name'] = $request->address_name;
        $data['address_phone'] = $request->address_phone;
        DB::table('tbl_address')->where('address_id', $address_id)->update($data);
        Session::put('message', 'Cập nhật thành công');

        return Redirect::to('/dia-chi');
    }
    // public function login_facebook(){
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function callback_facebook(){
    //     $provider = Socialite::driver('facebook')->user();

    //     $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
    //     if($account){
    //         //login in vao trang quan tri  
    //         $account_name = Customer::where('customer_id',$account->user)->first();
    //         Session::put('customer_name',$account_name->customer_name);
    //         Session::put('customer_id',$account_name->customer_id);
    //         return redirect('/')->with('message', 'Đăng nhập thành công');
    //     }else{

    //         $vi = new Social([
    //             'provider_user_id' => $provider->getId(),
    //             'provider' => 'facebook'
    //         ]);

    //         $orang = Customer::where('customer_email',$provider->getEmail())->first();

    //         if(!$orang){
    //             $orang = Customer::create([
    //                 'customer_name' => $provider->getName(),
    //                 'customer_email' => $provider->getEmail(),
    //                 'address_id' => null,
    //                 'customer_password' => '',
    //                 'customer_phone' => ''

    //             ]);
    //         }
    //         $vi->login()->associate($orang);
    //         $vi->save();

    //         $account_name = Customer::where('customer_id',$vi->user)->first();

    //         Session::put('customer_name',$account_name->customer_name);
    //          Session::put('customer_id',$account_name->customer_id);
    //         return redirect('/')->with('message', 'Đăng nhập thành công');
    //     } 

    // }
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        try {
            $users = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            // Nếu người dùng chọn hủy xác thực, bắt ngoại lệ và chuyển hướng về trang đăng nhập hoặc trang chủ với thông báo lỗi.
            return redirect('/login-register');
        }
        // return $users->id;
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            Session::put('login_gg', 1);
            Session::put('customer_email', $account_name->customer_email);
            Session::put('address_id', $account_name->address_id);
            return redirect('/')->with('message', 'Đăng nhập Admin thành công');
        } elseif ($new) {
            $account_name = Customer::where('customer_id', $new->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            Session::put('login_gg', 1);
            Session::put('customer_email', $account_name->customer_email);
            Session::put('address_id', $account_name->address_id);
        }

    }
    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if ($authUser) {

            return $authUser;
        } else {
            $new = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Customer::where('customer_email', $users->email)->first();

            if (!$orang) {
                $orang = Customer::create([
                    'customer_name' => $users->name,
                    'customer_email' => $users->email,
                    'address_id' => null,
                    'customer_password' => '',
                    

                ]);
            }
            $new->login()->associate($orang);
            $new->save();


            return $new;

        }



    }
    public function history_order()
    {
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $customer_id = Session::get('customer_id');
        $history_order = DB::table('tbl_order')->where('customer_id', $customer_id)->orderBy('order_id', 'desc')->get();

        return view('pages.customer.history_order')
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand)
            ->with('history_order', $history_order);
    }
    public function cancel_order($order_id)
    {

        DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 'Đã huỷ']);

        $value_order_detail = DB::table('tbl_order_detail')
            ->where('order_id', $order_id)
            ->get();

        foreach ($value_order_detail as $v_order) {

            $qty_old = DB::table('tbl_product')
                ->where('product_id', $v_order->product_id)
                ->first();

            if ($qty_old) {
                $new = array();
                $new['product_quantity'] = $qty_old->product_quantity + $v_order->product_quantity;
                $new['quantity_sold'] = $qty_old->quantity_sold - $v_order->product_quantity;
                DB::table('tbl_product')
                    ->where('product_id', $qty_old->product_id)
                    ->update($new);
            }
        }


        Session::put('cancel_order', 'Huỷ thành công');
        return Redirect()->back();
    }
    public function checked_order($order_id)
    {

        DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 'Đã nhận hàng']);

        Session::put('message', 'Xác nhận thành công');
        return Redirect()->back();
    }
    public function order_detail($order_id)
    {
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $history_order = DB::table('tbl_order')->where('tbl_order.order_id', $order_id)
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name', 'tbl_shipping.*', 'tbl_payment.*')
            ->orderBy('tbl_order.order_id', 'desc')->first();

        $order_detail = DB::table('tbl_order_detail')->where('tbl_order_detail.order_id', $order_id)->get();
        
        return view('pages.customer.order_detail')
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand)
            ->with('history_order', $history_order)
            ->with('order_detail', $order_detail);
    }
    public function add_wishlist(Request $request)
    {
        $wishlist = array();
        $wishlist['customer_id'] = Session::get('customer_id');
        $wishlist['product_id'] = $request->cart_product_id;
        DB::table('tbl_wishlist')->insert($wishlist);
        return Redirect()->back();
    }
    public function show_wishlist()
    {
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_slug', 'desc')->get();
        $product_wishlist = DB::table('tbl_wishlist')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_wishlist.product_id')
            ->where('tbl_wishlist.customer_id', Session::get('customer_id'))
            ->get();
        return view('pages.customer.wishlist')
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand)
            ->with('product_wishlist', $product_wishlist);

    }
    public function delete_wishlist($product_id)
    {
        DB::table('tbl_wishlist')->where('product_id', $product_id)->delete();
        return Redirect()->back();
    }
}
