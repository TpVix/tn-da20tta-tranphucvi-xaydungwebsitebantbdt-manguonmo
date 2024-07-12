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
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
           return Redirect::to('admin.dasboard');
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }
    public function add_product(){
        $this -> AuthLogin();
        $category = Category::orderBy('category_id','desc') -> get();
        $brand = Brand::orderBy('brand_id','desc') -> get();

        return view('admin.product.add_product') ->with('category', $category)->with('brand', $brand);
    }

    public function list_product(){
        $this -> AuthLogin();
        $all_product = DB::table('tbl_product')
        ->leftJoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->leftJoin('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->leftJoin('tbl_admin', 'tbl_admin.admin_id', '=', 'tbl_product.admin_id')
        ->orderBy('product_id','desc')->get();
        $manager_product = view('admin.product.list_product') -> with('all_product', $all_product);
        return view('admin_layout')->with('admin.list_product', $manager_product);
    }
    public function save_product(Request $request){
        $this -> AuthLogin();
        $data = array();
        $data['product_name'] = $request -> product_name;
        $data['product_slug'] = $request -> product_slug;
        $data['product_price'] = $request -> product_price;
        $data['product_quantity'] = $request -> product_quantity;
        $data['product_desc'] = $request -> product_desc;
        $data['category_id'] = $request -> category_id;
        $data['brand_id'] = $request -> brand_id;
        $data['admin_id'] = Session::get('admin_id');
        $request->validate([
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $get_image = $request -> file('product_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product') ->insert($data);
            Session::put('message','Thêm thành công');
           
            return Redirect::to('/add-product');
        }else{
            $data['product_image'] = "";
            DB::table('tbl_product') ->insert($data);
            Session::put('message','Thêm thành công');
           
            return Redirect::to('/add-product');
        }
       
    }

    public function edit_product($product_id){
        $this -> AuthLogin();
        $category = Category::orderBy('category_id','desc') -> get();
        $brand =Brand::orderBy('brand_id','desc') -> get();

        $product_image=DB::table('tbl_product_image')->where('product_id', $product_id)->get();
        $edit_product=DB::table('tbl_product')->where('product_id', $product_id)->get();

        return view('admin.product.edit_product')
        -> with('product_image',$product_image) 
        -> with('edit_product', $edit_product) 
        -> with('category', $category) 
        -> with('brand', $brand);
    }
    public function update_product(Request $request, $product_id){
        $this -> AuthLogin();
        $data = array();
        $data['product_name'] = $request -> product_name;
        $data['product_slug'] = $request -> product_slug;
        $data['product_price'] = $request -> product_price;
        $data['product_quantity'] = $request -> product_quantity;
        $data['product_desc'] = $request -> product_desc;
        $data['category_id'] = $request -> category_id;
        $data['brand_id'] = $request -> brand_id;
        $data['admin_id'] = Session::get('admin_id');
        $get_image = $request -> file('product_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id) ->update($data);
            Session::put('message','Cập nhật thành công');
           
            return Redirect::to('/list-product');
        }else{
            
            DB::table('tbl_product')->where('product_id', $product_id) ->update($data);
            Session::put('message','Cập nhật thành công');
           
            return Redirect::to('/list-product');
        }
        
        
    }
    public function delete_product($product_id){
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message','Xoá thành công');
        return Redirect::to('/list-product');
    }


    public function add_image($product_id){
        $this -> AuthLogin();
        $product_image=DB::table('tbl_product_image')->where('product_id', $product_id)->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        Session::put('product_id',$product_id);
        Session::put('product_name',$product->product_name);
        return view('admin.product.add_image') -> with('product_image', $product_image);
    }
    public function edit_image($image_id){
        $this -> AuthLogin();
        $product_image=DB::table('tbl_product_image')->where('product_id', Session::get('product_id'))->get();
        $edit_image =DB::table('tbl_product_image')->where('image_id', $image_id)->first();

        return view('admin.product.edit_image') 
        -> with('edit_image', $edit_image)
        -> with('product_image', $product_image);
    }
    public function save_image(Request $request){
        $this -> AuthLogin();
        $get_image = $request -> file('product_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload/product_image', $new_image);
            $data['image_url'] = $new_image;
            $data['product_id'] = Session::get('product_id');
            $data['product_name'] = Session::get('product_name');
            DB::table('tbl_product_image')->insert($data);
            Session::put('message','Thêm thành công');
           
            return Redirect::to('/add-image/'.Session::get('product_id'));
        }else{
            
           
            Session::put('message','Vui lòng thêm hình ảnh');
           
            return Redirect::to('/add-image/'.Session::get('product_id'));
        }
    }
    public function update_image($image_id,Request $request){
        $this -> AuthLogin();
        $get_image = $request -> file('product_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload/product_image', $new_image);
            $data['image_url'] = $new_image;
            
            DB::table('tbl_product_image')->where('image_id',$image_id)->update($data);
            Session::put('message','Sửa thành công');
           
            return Redirect::to('/add-image/'.Session::get('product_id'));
        }else{
            
           
            Session::put('message','Sửa thành công');
           
            return Redirect::to('/add-image/'.Session::get('product_id'));
        }
    }
    public function delete_image($image_id){
        $this -> AuthLogin();
        DB::table('tbl_product_image')->where('image_id',$image_id)->delete();
        Session::put('message','Xoá thành công');
           
        return Redirect::to('/add-image/'.Session::get('product_id'));
    }
}
