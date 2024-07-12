<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
           return Redirect::to('admin.dasboard');
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }
    public function add_brand_product(){
        $this -> AuthLogin();
        return view('admin.add_brand_product');
    }

    public function list_brand_product(){
        $this -> AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        $manager_brand_product = view('admin.list_brand_product') -> with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.list_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this -> AuthLogin();
        $data = $request -> all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request -> brand_product_name;
        // $data['brand_slug'] = $request -> brand_product_slug;
        // $data['brand_desc'] = $request -> brand_product_desc;
        // $data['brand_status'] = $request -> brand_product_status;
        // DB::table('tbl_brand') ->insert($data);
        Session::put('message','Thêm thành công');
       
        return Redirect::to('/add-brand');
    }
    public function active_brand_product($brand_product_id){
        $this -> AuthLogin();
        Brand::where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        return Redirect::to('/list-brand');
    }
    public function unactive_brand_product($brand_product_id){
        $this -> AuthLogin();
        Brand::where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        return Redirect::to('/list-brand');
    }

    public function edit_brand_product($brand_product_id){
        $this -> AuthLogin();
        $edit_brand_product=Brand::where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product') -> with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $this -> AuthLogin();
        $data = $request -> all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->save();
        Session::put('message','Cập nhật thành công');
       
        return Redirect::to('/list-brand');
    }
    public function delete_brand_product($brand_product_id){
        $this -> AuthLogin();
        Brand::where('brand_id', $brand_product_id)->delete();
        Session::put('message','Xoá thành công');
        return Redirect::to('/list-brand');
        
    }
}
