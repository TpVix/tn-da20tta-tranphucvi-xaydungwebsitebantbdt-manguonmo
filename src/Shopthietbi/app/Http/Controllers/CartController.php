<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Customer;
use App\Brand;
use App\Coupon;
use App\Category;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    // public function save_cart(Request $request){
    //     $product_id = $request -> productid_hidden;
    //     $quantity = $request -> quantity;
    //     $status = $request -> productstatus_hidden;

    //     $product_info = DB::table('tbl_product') -> where('product_id', $product_id)->first();
    //     $data['id'] = $product_info -> product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info -> product_name;
    //     if ($status=='0') {
    //         $data['price'] = $product_info -> product_price;
    //     }else{
    //         $data['price'] = $product_info -> product_sale_price;
    //     }
    //     $data['weight'] = '123';
    //     $data['options']['image'] = $product_info -> product_image;
    //     Cart::setGlobalTax(10);
    //     Cart::add($data);
    //     return Redirect::to('san-pham/'.$product_info -> product_slug);
    // }
    public function show_cart()
    {
        $category = Category::where('category_status', '1')->orderBy('category_slug', 'desc')->get();
        $all_accessory = DB::table('tbl_accessory')->where('accessory_status', 'Hiện')->orderBy('accessory_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $total_cart = 0;
        foreach ($cart_detail as $key => $v_cart_detail) {
            $total_cart += $v_cart_detail->product_quantity;
        }
        Session::put('total_cart', $total_cart);
        return view('pages.cart.show_cart')
            ->with('cart_detail', $cart_detail)
            ->with('category', $category)
            ->with('all_accessory', $all_accessory)
            ->with('brand', $brand);
    }
    public function delete_cart($product_id)
    {
       
        DB::table('tbl_cart_detail')
            ->where('product_id', $product_id)
            ->where('customer_id', Session::get('customer_id'))
            ->delete();
        

        return Redirect()->back();
    }
    public function update_cart($product_id, Request $request)
    {
        $value_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $cart_quantity = $request->input('cart_qty_' . $product_id);
        foreach ($value_product as $key => $v_product) {

            if ($cart_quantity && $cart_quantity > 0 && $cart_quantity < $v_product->product_quantity) {
                DB::table('tbl_cart_detail')
                    ->where('product_id', $product_id)
                    ->where('customer_id', Session::get('customer_id'))
                    ->update(['product_quantity' => $cart_quantity]);
            } else {
                Session::put('message', 'Số lượng không hợp lệ');
            }
        }
        return Redirect()->back();
    }


    public function add_cart(Request $request)
    {
        $cart_detail = DB::table('tbl_cart_detail')->where('customer_id', Session::get('customer_id'))->get();
        $total_cart = 0;
        foreach ($cart_detail as $key => $v_cart_detail) {
            $total_cart += $v_cart_detail->product_quantity;
        }
        Session::put('total_cart', $total_cart);
        
        $check = DB::table('tbl_product')->where('product_id', $request->cart_product_id)->first();
        
        if ($request->cart_product_qty > $check->product_quantity) {
            Session::put('sl_qua_lon', 'Số lượng không phù hợp');
            return Redirect()->back();
        } else {

            if ($cart_detail->isEmpty()) {
                $data_cart_detail = array();
                $data_cart_detail['customer_id'] = Session::get('customer_id');
                $data_cart_detail['product_id'] = $request->cart_product_id;
                $data_cart_detail['product_image'] = $request->cart_product_image;
                $data_cart_detail['product_name'] = $request->cart_product_name;
                $data_cart_detail['product_price'] = $request->cart_product_price;
                $data_cart_detail['product_quantity'] = $request->cart_product_qty;
                DB::table('tbl_cart_detail')->insert($data_cart_detail);
            } else {
                $product_exist = false;
                foreach ($cart_detail as $key => $v_cart_detail) {
                    if ($v_cart_detail->product_id == $request->cart_product_id) {
                        $data_cart_detail = array();
                        $data_cart_detail['customer_id'] = Session::get('customer_id');
                        $data_cart_detail['product_id'] = $request->cart_product_id;
                        $data_cart_detail['product_image'] = $request->cart_product_image;
                        $data_cart_detail['product_name'] = $request->cart_product_name;
                        $data_cart_detail['product_price'] = $request->cart_product_price;
                        $data_cart_detail['product_quantity'] = $v_cart_detail->product_quantity + $request->cart_product_qty;
                        DB::table('tbl_cart_detail')->where('cart_detail_id', $v_cart_detail->cart_detail_id)->update($data_cart_detail);
                        $product_exist = true;
                        break;
                    }
                }
                if (!$product_exist) {
                    $data_cart_detail = array();
                    $data_cart_detail['customer_id'] = Session::get('customer_id');
                    $data_cart_detail['product_id'] = $request->cart_product_id;
                    $data_cart_detail['product_image'] = $request->cart_product_image;
                    $data_cart_detail['product_name'] = $request->cart_product_name;
                    $data_cart_detail['product_price'] = $request->cart_product_price;
                    $data_cart_detail['product_quantity'] = $request->cart_product_qty;
                    DB::table('tbl_cart_detail')->insert($data_cart_detail);
                }
            }
            return Redirect()->back();
        }
    }


}
