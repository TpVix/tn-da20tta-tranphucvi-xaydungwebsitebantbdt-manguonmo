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

class AccessoryController extends Controller
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
    public function add_accessory()
    {
        $this->AuthLogin();

        $accessory = DB::table('tbl_accessory')->orderBy('accessory_id','desc')->get();
        return view('admin.accessory.add_accessory')
        ->with('accessory',$accessory);
    }
    public function save_accessory(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['accessory_name'] = $request->accessory_name;
        $data['accessory_slug'] = $request->accessory_slug;
        $data['accessory_status'] = $request->accessory_status;
        DB::table('tbl_accessory')->insert($data);
        Session::put('message', 'Thêm thành công');

        return Redirect::to('/add-accessory');
    }
    public function edit_accessory($accessory_id,Request $request)
    {
      
        $this->AuthLogin();
       
        $accessory = DB::table('tbl_accessory')->orderBy('accessory_id','desc')->get();
        $accessory_edit = DB::table('tbl_accessory')->where('accessory_id',$accessory_id)->first();
        return view('admin.accessory.edit_accessory')
        ->with('accessory',$accessory)
        ->with('accessory_edit',$accessory_edit);


    }
    public function update_accessory($accessory_id,Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['accessory_name'] = $request->accessory_name;
        
        $data['accessory_status'] = $request->accessory_status;
        $data['accessory_slug'] = $request->accessory_slug;
        DB::table('tbl_accessory')->where('accessory_id',$accessory_id)->update($data);
        Session::put('message', 'Chỉnh sửa thành công');
        
        return Redirect::to('/add-accessory');


    }
    public function delete_accessory($accessory_id,Request $request)
    {
        $product_accessory = DB::table('tbl_product')
        ->where('accessory_id', $accessory_id)->first();
        if (isset($product_accessory)) {
            Session::put('delete','Không thể xoá do còn thành phần phụ');
            return Redirect::to('/add-accessory');
        }else {
            DB::table('tbl_accessory')->where('accessory_id',$accessory_id)->delete();
            Session::put('delete','Xoá thành công');
            return Redirect::to('/add-accessory');
        }
    }
    public function product_accessory($accessory_id,Request $request)
    {
       Session::put('accessory_id',$accessory_id);
        // $all_product = DB::table('tbl_product')
        // ->leftJoin('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        
        // ->leftJoin('tbl_accessory', 'tbl_accessory.accessory_id', '=', 'tbl_product.accessory_id')
        // ->where('category_id',0)
        // ->orderBy('product_id','desc')->get();
       
        
        $accessory_ids = DB::table('tbl_accessory_product')
            ->where('tbl_accessory_product.accessory_id',$accessory_id)
            ->get();
       
        $all_product = DB::table('tbl_product')
            ->leftJoin('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            // ->leftJoin('tbl_accessory_product', 'tbl_accessory_product.product_id', '=', 'tbl_product.product_id')
            // ->leftJoin('tbl_accessory', 'tbl_accessory.accessory_id', '=', 'tbl_accessory_product.accessory_id')
            ->where('tbl_product.category_id', 0)
            
            // ->where('tbl_accessory_product.accessory_id','!=', $accessory_ids)
            ->orderBy('tbl_product.product_id', 'desc')
            ->get();
         
        $accessory_name = DB::table('tbl_accessory')->where('accessory_id',$accessory_id)->first();
       
        $product_accessory = DB::table('tbl_product')
        ->Join('tbl_accessory_product', 'tbl_accessory_product.product_id', '=', 'tbl_product.product_id')
        ->Join('tbl_accessory', 'tbl_accessory.accessory_id', '=', 'tbl_accessory_product.accessory_id')
        ->where('tbl_accessory.accessory_id',$accessory_id)
        ->orderBy('tbl_product.product_id','desc')->get();
        return view('admin.accessory.product_accessory')->with(compact('all_product','accessory_ids','accessory_id','accessory_name','product_accessory'));
    }
    public function chose_product_accessory(Request $request)
    {
        $product_ids = $request->input('ids');
        $accessory_id = Session::get('accessory_id');
        foreach ($product_ids as $product_id) {
            $data = [
                'product_id' => $product_id,
                'accessory_id' => $accessory_id,
            ];
            DB::table('tbl_accessory_product')
            ->insert($data);
        }
       
        Session::put('chose_success','Thêm thành công');
        return Redirect()->back();
    }
    public function delete_product_accessory($product_id)
    {
        DB::table('tbl_accessory_product')
        ->where('accessory_id', Session::get('accessory_id'))
        ->where('product_id', $product_id)
        ->delete();
        Session::put('chose_success','Xoá thành công');
        return Redirect()->back();
    }

    public function add_promotion_accessory()
    {
        $this->AuthLogin();
       
        $promotion_accessory = DB::table('tbl_promotion_accessory')->orderBy('promotion_accessory_id','desc')->get();
        $brand_name = [];
        foreach ($promotion_accessory as $key => $v_promotion_accessory) {
            if (!is_null($v_promotion_accessory->brand_name)) {
                $brand_name[] = $v_promotion_accessory->brand_name;
            }
        }

        $brand = Brand::orderBy('brand_id', 'desc')
        ->whereNotIn('brand_name',$brand_name)
        ->get();
   
        return view('admin.accessory.add_promotion_accessory')
        ->with('promotion_accessory',$promotion_accessory)
        ->with('brand', $brand);
    }
    public function save_promotion_accessory(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['promotion_accessory_price'] = $request->promotion_accessory_price;
        $data['promotion_accessory_des'] = $request->promotion_accessory_des;
        $data['promotion_accessory_status'] = $request->promotion_accessory_status;
        $data['promotion_accessory_option'] = $request->promotion_accessory_option;
        DB::table('tbl_promotion_accessory')->insert($data);
        Session::put('message', 'Thêm thành công');


        
        return Redirect::to('/add-promotion-accessory');


    }
    public function edit_promotion_accessory($promotion_accessory_id,Request $request)
    {
      
        $this->AuthLogin();
        $brand = Brand::orderBy('brand_id', 'desc')->get();
        $promotion_accessory = DB::table('tbl_promotion_accessory')->orderBy('promotion_accessory_id','desc')->get();
        $promotion_accessory_edit = DB::table('tbl_promotion_accessory')->where('promotion_accessory_id',$promotion_accessory_id)->first();
        return view('admin.accessory.edit_promotion_accessory')
        ->with('promotion_accessory',$promotion_accessory)
        ->with('brand', $brand)
        ->with('promotion_accessory_edit',$promotion_accessory_edit);


    }
    public function update_promotion_accessory($promotion_accessory_id,Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['promotion_accessory_price'] = $request->promotion_accessory_price;
        $data['promotion_accessory_des'] = $request->promotion_accessory_des;
        $data['promotion_accessory_status'] = $request->promotion_accessory_status;
        $data['promotion_accessory_option'] = $request->promotion_accessory_option;
        DB::table('tbl_promotion_accessory')->where('promotion_accessory_id',$promotion_accessory_id)->update($data);
        Session::put('message', 'Chỉnh sửa thành công');
        
        return Redirect::to('/add-promotion-accessory');


    }
    public function delete_promotion_accessory($promotion_accessory_id,Request $request)
    {
        $product_promotion_accessory = DB::table('tbl_promotion_accessory_product')
        ->where('promotion_accessory_id', $promotion_accessory_id)->first();
        if (isset($product_promotion_accessory)) {
            Session::put('delete','Không thể xoá do còn thành phần phụ');
            return Redirect::to('/add-promotion-accessory');
        }else {
            DB::table('tbl_promotion_accessory')->where('promotion_accessory_id',$promotion_accessory_id)->delete();
            Session::put('delete','Xoá thành công');
            return Redirect::to('/add-promotion-accessory');
        }
    }
    public function product_promotion_accessory($promotion_accessory_id,Request $request)
    {
       Session::put('promotion_accessory_id',$promotion_accessory_id);
       $promotion_accessory_ids = DB::table('tbl_promotion_accessory_product')
       ->where('tbl_promotion_accessory_product.promotion_accessory_id',$promotion_accessory_id)
       ->get();
       
        $promotion_accessory_name = DB::table('tbl_promotion_accessory')->where('promotion_accessory_id',$promotion_accessory_id)->first();
        
       
            $all_product = DB::table('tbl_product')
            ->where('category_id',0)
            ->orderBy('product_id','desc')->get();
      
        $product_promotion_accessory = DB::table('tbl_product')
        ->Join('tbl_promotion_accessory_product', 'tbl_product.product_id', '=', 'tbl_promotion_accessory_product.product_id')
        ->Join('tbl_promotion_accessory', 'tbl_promotion_accessory.promotion_accessory_id', '=', 'tbl_promotion_accessory_product.promotion_accessory_id')
        ->where('tbl_promotion_accessory_product.promotion_accessory_id',$promotion_accessory_id)
        ->orderBy('tbl_product.product_id','desc')->get();
      
        return view('admin.accessory.product_promotion_accessory')->with(compact('all_product','promotion_accessory_ids','promotion_accessory_id','promotion_accessory_name','product_promotion_accessory'));
    }
    public function chose_promotion_accessory_product(Request $request)
    {
        
        $product_ids = $request->input('ids');
        $promotion_accessory_id = Session::get('promotion_accessory_id');
        foreach ($product_ids as $product_id) {
            $data = [
                'product_id' => $product_id,
                'promotion_accessory_id' => $promotion_accessory_id,
            ];
            DB::table('tbl_promotion_accessory_product')->insert($data);
        }
        Session::put('chose','Thêm thành công');
        return Redirect()->back();
    }
    public function delete_product_promotion_accessory($product_id)
    {
        DB::table('tbl_promotion_accessory_product')
        ->where('promotion_accessory_id', Session::get('promotion_accessory_id'))
        ->where('product_id', $product_id)
        ->delete();
        Session::put('chose_success','Xoá thành công');
        return Redirect()->back();
    }
}
