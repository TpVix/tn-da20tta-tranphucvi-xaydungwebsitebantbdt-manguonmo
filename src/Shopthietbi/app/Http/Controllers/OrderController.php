<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use PDF;

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
           return Redirect::to('admin.dasboard');
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }
    public function manage_order(){
        $this -> AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_customers.customer_name', 'tbl_shipping.*')
        ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage_order') -> with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function view_order($order_id){
        $this -> AuthLogin();
        $order_detail = DB::table('tbl_order') ->where('tbl_order.order_id',$order_id)
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->select('tbl_order.*','tbl_customers.customer_name', 'tbl_shipping.*','tbl_payment.*')
        ->orderBy('tbl_order.order_id','desc')->first();

        $order_product_detail = DB::table('tbl_order_detail') ->where('tbl_order_detail.order_id',$order_id)->get();
        $manager_order_detail = view('admin.view_order') -> with('order_detail', $order_detail) -> with('order_product_detail', $order_product_detail);
        return view('admin_layout')->with('admin.view_order', $manager_order_detail);
    }
    public function acept_order($order_id){
        DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 'Đặt thành công, Đang giao hàng']);
        Session::put('acept_order','Đặt thành công, Đang giao hàng');
        return Redirect()->back();
    }
    public function delete_order($order_id){
        $this -> AuthLogin();
        DB::table('tbl_order') ->where('tbl_order.order_id',$order_id)->delete();
        
        return Redirect()->back();
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    
    public function print_order_convert($checkout_code){
        $order_detail = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name', 'tbl_shipping.*', 'tbl_payment.*')
            ->orderBy('tbl_order.order_id', 'desc')
            ->where('tbl_order.order_id', $checkout_code)
            ->first();
        
        // Truy vấn chi tiết sản phẩm trong đơn hàng
        $order_product_detail = DB::table('tbl_order_detail')
            ->where('tbl_order_detail.order_id', $checkout_code)
            ->get();
        
        // Kiểm tra nếu đơn hàng hoặc chi tiết sản phẩm bị null
        if (!$order_detail || $order_product_detail->isEmpty()) {
            return 'Không tìm thấy đơn hàng hoặc chi tiết đơn hàng';
        }
    
        $output = '';
        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
            }
            .table-style {
                width: 100%;
                border-collapse: collapse;
            }
            .table-style td, .table-style th {
                border: 1px solid black;
                padding: 10px;
            }
        </style>
        <h1><center>Shop thiết bị</center></h1>
        <h4><center>Địa chỉ: Khóm 7, phường 8, Thành phố Trà Vinh, Trà Vinh</center></h4>
        <h4><center>Số điện thoại: 0869283299</center></h4>
        <h3><center>HOÁ ĐƠN BÁN HÀNG</center></h3>
        <table class="table-style">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>';
        
        $total = 0;
        foreach ($order_product_detail as $order_p_detail) {
            $subtotal = $order_p_detail->product_price * $order_p_detail->product_quantity;
            $total += $subtotal;
            $output .= '
                <tr>
                    <td>' . $order_p_detail->product_name . '</td>
                    <td>' . $order_p_detail->product_quantity . '</td>
                    <td>' . number_format($order_p_detail->product_price, 0, ',', '.') . 'đ</td>
                    <td>' . number_format($subtotal, 0, ',', '.') . 'đ</td>
                </tr>';
        }
    
        $output .= '
            <tr>
                <td colspan="2"></td>
                <td>Tổng giá:</td>
                <td>' . number_format($total, 0, ',', '.') . 'đ</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Tiền ship:</td>
                <td>' . number_format($order_detail->shipping_fee, 0, ',', '.') . 'đ</td>
            </tr>
            </tbody>
        </table>
        <table class="table-style">
            <tr>
            <td>Thành tiền:</td>';
    
           
                $output .= '<td><center><b>' . number_format($order_detail->order_total, 0, ',', '.') . 'đ</b></center></td>';
           
        
            $output .= '
                </tr>
            <tr>
                <td>Người đặt hàng:</td>
                <td><center><b>' . $order_detail->shipping_name . '</b></center></td>
            </tr>
            <tr>
                <td>Địa chỉ nhận hàng:</td>
                <td><center><b>' . $order_detail->shipping_address . '</b></center></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <th>Người đặt hàng</th>
                <th>Người bán hàng</th>
            </tr>
        </table>';
    
        return $output;
    }
    
}
