<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Customer;
use App\Brand;
use App\Category;
use Mail;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;


class ReviewController extends Controller
{
    public function list_review (){
        $list_review = DB::table('tbl_rating')->orderBy('rating_id','desc')->get();
        return view('admin.review.list_review')->with(compact('list_review'));
    }

    public function list_comment (){
        $list_comment = DB::table('tbl_comment')->orderBy('comment_id','desc')->get();
        return view('admin.review.list_comment')->with(compact('list_comment'));
    }
    public function acept_comment ($comment_id){
        DB::table('tbl_comment')->where('comment_id',$comment_id)->update(['comment_status'=> 'Đã duyệt']);
        Session::put('acept_comment','Duyệt thành công');
        return Redirect()->back();
    }
    public function delete_comment ($comment_id){
        DB::table('tbl_comment')->where('comment_id',$comment_id)->delete();

        Session::put('delete_comment','Xoá thành công');
        return Redirect()->back();
    }
}
