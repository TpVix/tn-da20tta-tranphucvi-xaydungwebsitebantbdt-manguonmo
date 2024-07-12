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

class DeliveryController extends Controller
{
    public function manage_delivery(){
        $city = DB::table('tbl_tinhthanhpho')->orderBy('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));    
    }
    public function select_delivery(Request $request){
        $data= $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=='city'){
                $select_district = DB::table('tbl_quanhuyen')->where('matp', $data['ma_id'])->orderBy('maqh','ASC')->get();
                $output .= '<option >--Chọn quận/huyện--</option>';
                foreach ($select_district as $district) {
                    $output .= '<option value="'.$district->maqh.'">'.$district->name_quanhuyen.'</option>';
                }
                
            }else{
                $select_ward = DB::table('tbl_xaphuongthitran')->where('maqh', $data['ma_id'])->orderBy('xaid','ASC')->get();
                $output .= '<option >--Chọn xã/phường/thị trấn--</option>';
                foreach ($select_ward as $ward) {
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuongthitran.'</option>';
                }
            }
        }
        echo $output;
       
    }
    public function insert_delivery(Request $request){
        $data= array();
        $data['matp'] = $request->city;
        $data['maqh'] = $request->district;
        $data['xaid'] = $request->ward;
        $data['shipping_fee_price'] = $request->shipping_fee_price;

        DB::table('tbl_shipping_fee') -> insert($data);
        
    }
    public function select_shipping_fee(){
        $shipping_fee = DB::table('tbl_shipping_fee')
        -> join('tbl_tinhthanhpho','tbl_tinhthanhpho.matp', '=','tbl_shipping_fee.matp')
        -> join('tbl_quanhuyen','tbl_quanhuyen.maqh', '=','tbl_shipping_fee.maqh')
        -> join('tbl_xaphuongthitran','tbl_xaphuongthitran.xaid', '=','tbl_shipping_fee.xaid')
        -> orderBy('id_shipping_fee','DESC')
        -> get();

        $output = '';
        $output .='
        <table id="responsive-data-table" class="table">
        <thead>
            <tr>
                <th>Tên thành phố</th>
                <th>Tên quận huyện</th>
                <th>Tên xã phường</th>
                <th>Phí ship</th>
                
            </tr>
        </thead>

        <tbody>
        ';
        foreach ($shipping_fee as $key => $fee) {
            $output .='
            <tr>
          
                
                <td>'.$fee->name_tinhthanhpho.'</td>
                <td>'.$fee->name_quanhuyen.'</td>
                <td>'.$fee->name_xaphuongthitran.'</td>
                <td contenteditable data-shipping_fee_id="'.$fee->id_shipping_fee.'" class="edit_shipping_fee">'.number_format($fee->shipping_fee_price,0,',','.').'đ'.'</td>
                
            </tr>
            ';
        }
            $output .='   
        </tbody>
    </table>';
    
        
    return $output;
    }
    public function update_delivery(Request $request){
        $data= array();
        $data['shipping_fee_price'] = $request->fee_value;
        DB::table('tbl_shipping_fee')->where('id_shipping_fee', $request->feeship_id) -> update($data);
    }
}
