<?php

namespace App\Http\Controllers;

use App\Login;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

session_start();
class AdminController extends Controller
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
    public function index()
    {
        return view('admin_login');
    }
    public function admin_register()
    {
        $this -> AuthLogin();
        return view('admin_register');
    }
    public function dashboard()
    {
        $this->AuthLogin();
        $count_customer = DB::table('tbl_customers')->count();
        $daily_order = DB::table('tbl_order')
        ->whereRaw('DATE(created_at) = CURDATE()')
        ->count();
        
        $total = DB::table('tbl_order')
        ->whereRaw('DATE(created_at) = CURDATE()')
        ->sum('order_total');
        $all_total = DB::table('tbl_order')->sum('order_total');

        $all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name', 'tbl_payment.*')
            ->orderBy('tbl_order.order_id', 'desc')->take(3)->get();
     
        $order_status_counts = DB::table('tbl_order')
            ->select('order_status', DB::raw('count(*) as count'))
            ->groupBy('order_status')
            ->get()
            ->map(function ($item) {
                return [
                    'order_status' => $item->order_status,
                    'count' => $item->count
                ];
            });
        $order_status_colors = [
            'Đã nhận hàng' => '#a4d9e5',
            'Đang chờ xử lý' => '#80e1c1',
            'Đặt thành công, Đang giao hàng' => '#8061ef',
            'Đã huỷ' => '#ffa128',
        ];


        $order_counts_day = DB::table('tbl_order')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();

        $selling_products = DB::table('tbl_product')
        ->orderBy('quantity_sold', 'desc')
        ->take(3)
        ->get();

        $potential_customer = DB::table('tbl_customers')
        ->join('tbl_order', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select(
            'tbl_customers.customer_id',
            DB::raw('count(tbl_order.order_id) as order_count'),
            DB::raw('SUM(tbl_order.order_total) as total_order_amount')
        )        
        ->groupBy('tbl_customers.customer_id')
        ->orderBy('total_order_amount','desc')
        ->take(5)
        ->get();

        return view('admin.dashboard')
            ->with(
                compact(
                    'count_customer',
                    'daily_order',
                    'total',
                    'all_total',
                    'all_order',
                    'potential_customer',
                    'selling_products',
                    'order_status_counts',
                    'order_status_colors',
                    'order_counts_day'
                )
            );
    }
    public function account_profile($admin_id)
    {
        $this -> AuthLogin();
        $admin = DB::table('tbl_admin')->where('admin_id', Session::get('admin_id'))
            ->join('tbl_role', 'tbl_role.role_id', '=', 'tbl_admin.role_id')
            ->first();

        return view('admin.account.account_profile')->with(compact('admin'));
    }
    public function update_profile($admin_id, Request $request)
    {
        $this -> AuthLogin();
        $admin = DB::table('tbl_admin')->where('admin_id', Session::get('admin_id'))->first();

        if (isset($request->old_password, $request->new_password) && Hash::check($request->old_password, $admin->admin_password)) {
            $data = array();
            $data['admin_password'] = bcrypt($request->new_password);
            DB::table('tbl_admin')->where('admin_id', Session::get('admin_id'))->update($data);
            Session::put('success', 'Cập nhật thành công');
            return Redirect()->back();
        } else {
            Session::put('danger', 'Mật khẩu không chính xác, hoặc nhập thiếu');
            return Redirect()->back();
        }


    }
    public function update_phone($admin_id, Request $request)
    {
        $this -> AuthLogin();
        $data = array();
        $data['admin_phone'] = $request->admin_phone;
        DB::table('tbl_admin')->where('admin_id', Session::get('admin_id'))->update($data);
        Session::put('success', 'Cập nhật thành công');

        return Redirect()->back();
    }
    public function check_adminlogin(Request $request)
    {
        $credentials = $request->only('admin_name', 'admin_password');

        if (Auth::guard('admin')->attempt(['admin_name' => $credentials['admin_name'], 'password' => $credentials['admin_password']])) {
            $admin = Login::where('admin_name', $credentials['admin_name'])->first();
            Session::put('admin_id', $admin->admin_id);

            Session::put('admin_name', $credentials['admin_name']);
            return redirect('/dashboard');
        } else {

            Session::put('message', 'Tài khoản hoặc mật khẩu sai, vui lòng nhập lại');
            return Redirect::to('/login-admin');
        }
    }
    // public function check_adminlogin(Request $request){
    //     $admin_name = $request->admin_name;
    //     $admin_password = md5($request->admin_password);

    //     $result = Login::where('admin_name',$admin_name)->where('admin_password',$admin_password)->first();

    //     if($result){
    //         Session::put('admin_id', $result->admin_id);
    //         Session::put('admin_name', $result->admin_name);
    //         return Redirect::to('/dashboard');
    //     }else{
    //         Session::put('message','Tài khoản hoặc mật khẩu sai, vui lòng nhập lại');
    //         return Redirect::to('/login-admin');
    //     }

    // }
    public function save_admin(Request $request)
    {
        $this -> AuthLogin();
        $admin = new Login();

        $data = $request->all();
        $check = $admin::where('admin_name', $data['admin_name'])->first();
        if ($check) {
            Session::put('message', 'Tài khoản đã tồn tại');
        } else {
            $admin->role_id = $data['role_id'];
            $admin->admin_name = $data['admin_name'];
            $admin->admin_phone = $data['admin_phone'];
            $admin->admin_password = bcrypt($data['admin_password']);
            $admin->save();
        }
        return Redirect::to('/list-account');
    }
    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);

        return Redirect::to('/login-admin');
    }
    public function list_account()
    {
        $this->AuthLogin();

        $admin_admin_role = DB::table('tbl_admin')
            ->join('tbl_role', 'tbl_admin.role_id', '=', 'tbl_role.role_id')
            ->orderBy('tbl_role.role_id', 'asc')
            ->get();

        $all_role = DB::table('tbl_role')->orderBy('role_id', 'asc')->get();
        return view('admin.account.list_add_account')->with(compact('admin_admin_role', 'all_role'));
    }
    public function list_customer()
    {
        $this->AuthLogin();

        $customer_all = DB::table('tbl_customers')
        ->leftjoin('tbl_order', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select(
            'tbl_customers.customer_id',
            DB::raw('count(tbl_order.order_id) as order_count'),
            DB::raw('SUM(tbl_order.order_total) as total_order_amount')
        )        
        ->groupBy('tbl_customers.customer_id')
        ->orderBy('total_order_amount','desc')
        ->get();

        return view('admin.customer.list_add_customer')->with(compact('customer_all'));
    }
    public function permisstion($role_id, Request $request)
    {
        $this -> AuthLogin();
        $admin_id = $request->admin_id;
        if ($admin_id == Session::get('admin_id')) {
            Session::put('permisstion', 'Không được phân quyền cho chính mình');
        } else {
            DB::table('tbl_admin')->where('admin_id', $admin_id)->update(['role_id' => $role_id]);
            Session::put('permisstion', 'Phân quyền thành công');
        }

        return Redirect()->back();
    }
    public function delete_account($admin_id)
    {
        $this -> AuthLogin();
        $admin_role = DB::table('tbl_admin')->where('admin_id', $admin_id)->first();
        if ($admin_id == Session::get('admin_id') || $admin_role->role_id == '1') {
            Session::put('delete_account', 'Tài khoản này không thể bị xoá');
        } else {
            DB::table('tbl_admin')->where('admin_id', $admin_id)->delete();
            Session::put('delete_account', 'Xoá thành công');
        }
        return Redirect()->back();
    }
}
