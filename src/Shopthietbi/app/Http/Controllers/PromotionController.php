<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Brand;
use App\Category;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;

session_start();

class PromotionController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('admin.dasboard');
        } else {
            return Redirect::to('/login-admin')->send();
        }
    }
    public function add_promotion()
    {
        $this->AuthLogin();
        $category = Category::orderBy('category_id', 'desc')->get();
        $promotion = DB::table('tbl_promotion')->orderBy('promotion_id','desc')->get();
        $brand_name = [];
        foreach ($promotion as $key => $v_promotion) {
            if (!is_null($v_promotion->brand_name)) {
                $brand_name[] = $v_promotion->brand_name;
            }
        }
       
        $brand = Brand::orderBy('brand_id', 'desc')
        ->whereNotIn('brand_name',$brand_name)
        ->get();
   
        return view('admin.promotion.add_promotion')->with('category', $category)
        ->with('promotion',$promotion)
        ->with('brand', $brand);
    }
    public function save_promotion(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['promotion_name'] = $request->promotion_name;
        $data['brand_name'] = $request->brand_name;
        $data['promotion_price'] = $request->promotion_price;
        $data['promotion_des'] = $request->promotion_des;
        $data['promotion_status'] = $request->promotion_status;
        $data['promotion_option'] = $request->promotion_option;
        DB::table('tbl_promotion')->insert($data);
        Session::put('message', 'Thêm thành công');


        
        return Redirect::to('/add-promotion');


    }
    public function edit_promotion($promotion_id,Request $request)
    {
      
        $this->AuthLogin();
        $category = Category::orderBy('category_id', 'desc')->get();
        $brand = Brand::orderBy('brand_id', 'desc')->get();
        $promotion = DB::table('tbl_promotion')->orderBy('promotion_id','desc')->get();
        $promotion_edit = DB::table('tbl_promotion')->where('promotion_id',$promotion_id)->first();
        return view('admin.promotion.edit_promotion')->with('category', $category)
        ->with('promotion',$promotion)
        ->with('brand', $brand)
        ->with('promotion_edit',$promotion_edit);


    }
    public function update_promotion($promotion_id,Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['promotion_name'] = $request->promotion_name;
        $data['brand_name'] = $request->brand_name;
        $data['promotion_price'] = $request->promotion_price;
        $data['promotion_des'] = $request->promotion_des;
        $data['promotion_status'] = $request->promotion_status;
        $data['promotion_option'] = $request->promotion_option;
        DB::table('tbl_promotion')->where('promotion_id',$promotion_id)->update($data);
        Session::put('message', 'Chỉnh sửa thành công');
        
        return Redirect::to('/add-promotion');


    }
    public function delete_promotion($promotion_id,Request $request)
    {
        $product_promotion = DB::table('tbl_product')
        ->where('promotion_id', $promotion_id)->first();
        if (isset($product_promotion)) {
            Session::put('delete','Không thể xoá do còn thành phần phụ');
            return Redirect::to('/add-promotion');
        }else {
            DB::table('tbl_promotion')->where('promotion_id',$promotion_id)->delete();
            Session::put('delete','Xoá thành công');
            return Redirect::to('/add-promotion');
        }
    }
    public function product_promotion($promotion_id,Request $request)
    {
       Session::put('promotion_id',$promotion_id);
        
       $promotion_ids = DB::table('tbl_product')
       ->where('promotion_id',$promotion_id)
       ->get();
      
        $promotion_name = DB::table('tbl_promotion')->where('promotion_id',$promotion_id)->first();
        
        if ($promotion_name->brand_name != '' ) {
            $all_product = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_brand.brand_name',$promotion_name->brand_name)
            ->orderBy('product_id','desc')->get();

           
        } else {
            $all_product = DB::table('tbl_product')
            ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->leftJoin('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('promotion_id',0)
            ->where('tbl_product.category_id','!=',0)
            ->orderBy('product_id','desc')->get();
           
        }
        
      
        $product_promotion = DB::table('tbl_product')
        ->where('promotion_id',$promotion_id)
        ->orderBy('product_id','desc')->get();
        return view('admin.promotion.product_promotion')->with(compact('all_product','promotion_id','promotion_ids','promotion_name','product_promotion'));
    }
    public function chose_product(Request $request)
    {
        $product_ids = $request->input('ids');
        $promotion_id = Session::get('promotion_id');
        foreach ($product_ids as $product_id) {
            DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['promotion_id' => $promotion_id]);
        }   

        Session::put('chose_success','Thêm thành công');
        return Redirect()->back();
    }
    public function delete_product_promotion($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)
        ->update(['promotion_id' => 0]);

        Session::put('chose_success','Xoá thành công');
        return Redirect()->back();
    }
}
