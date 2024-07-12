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

class SliderControllder extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
           return Redirect::to('admin.dasboard');
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }
    public function add_slider(){
        $this -> AuthLogin();
        $category = Category::orderBy('category_id','desc') -> get();
        $brand = Brand::orderBy('brand_id','desc') -> get();

        return view('admin.slider.add_slider') ->with('category', $category)->with('brand', $brand);
    }
    public function edit_slider($slider_id){
        $this -> AuthLogin();
        $category = Category::orderBy('category_id','desc') -> get();
        $brand =Brand::orderBy('brand_id','desc') -> get();

        $edit_slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->first();
        return view('admin.slider.edit_slider') -> with('edit_slider', $edit_slider) -> with('category', $category) -> with('brand', $brand);
    }
    public function save_slider(Request $request){
        $this -> AuthLogin();
        $data = array();
        $data['slider_option'] = $request -> slider_option;
        $data['slider_status'] = $request -> slider_status;

        $get_image = $request -> file('slider_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload/banner', $new_image);
            $data['slider_image'] = $new_image;
            DB::table('tbl_slider') ->insert($data);
            Session::put('message','Thêm thành công');
           
            return Redirect::to('/add-slider');
        }else{
            $data['slider_image'] = "";
            DB::table('tbl_slider') ->insert($data);
            Session::put('message','Thêm thành công');
           
            return Redirect::to('/add-slider');
        }
       
    }
    public function update_slider($slider_id,Request $request){
        $this -> AuthLogin();
        $data = array();
        $data['slider_option'] = $request -> slider_option;
        $data['slider_status'] = $request -> slider_status;

        $get_image = $request -> file('slider_image');
        if($get_image){
            $get_name = $get_image -> getClientOriginalName();
            $new_image = sha1(uniqid(mt_rand(), true)) . '_' . $get_name;
            $get_image->move('public/upload/banner', $new_image);
            $data['slider_image'] = $new_image;
            DB::table('tbl_slider') -> where('slider_id',$slider_id) ->update($data);
            Session::put('message','Sửa thành công');
           
            return Redirect::to('/list-slider');
        }else{
            
            DB::table('tbl_slider') -> where('slider_id',$slider_id) ->update($data);
            Session::put('message','Sửa thành công');
           
            return Redirect::to('/list-slider');
        }
    }
    public function list_slider(){
        $this -> AuthLogin();
        $all_slider = DB::table('tbl_slider')
        ->orderBy('slider_id','desc')->get();
        return view('admin.slider.list_slider') -> with('all_slider', $all_slider);
    }

    public function change_option($slider_id){
        $this -> AuthLogin();

        $slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->get();
        foreach ($slider as $key => $v_slider) {
            if ($v_slider->slider_option == 1) {
                DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_option'=>2]);
                return Redirect::to('/list-slider');
            } elseif ($v_slider->slider_option == 2) {
                DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_option'=>3]);
                return Redirect::to('/list-slider');
            } else{
                DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_option'=>1]);
                return Redirect::to('/list-slider');
            }
        }
       
    }
    public function status_slider($slider_id){
        $this -> AuthLogin();

        $slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->get();
        foreach ($slider as $key => $v_slider) {
            if ($v_slider->slider_status == 0) {
                DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>1]);
                return Redirect::to('/list-slider');
           
            } else{
                DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>0]);
                return Redirect::to('/list-slider');
            }
        }
       
    }
    public function delete_slider($slider_id){
        $this -> AuthLogin();
        DB::table('tbl_slider')->where('slider_id', $slider_id)->delete();
        Session::put('message','Xoá thành công');
        return Redirect::to('/list-slider');
    }
}
