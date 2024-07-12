
@extends('pages.layout.layout')
@section('content')
<div  id="order" role="tabpanel">
    <div class="order-content">
        <h3 class="account-sub-title d-none d-md-block"><i
                class="sicon-social-dropbox align-middle mr-3"></i>Chi tiết đơn hàng: {{$history_order->order_name}}</h3>
        <div class="order-table-container text-center">
            <table class="table table-order text-left">
                <thead>
                    <tr>
                        <th style="width: 15%;" class="order-id">Hình</th>
                        <th class="order-date">Tên sản phẩm</th>
                        <th style="width: 15%;" class="order-status">Số lượng</th>
                        <th class="order-price">Giá tiền</th>
                        <th class="order-price">Tổng phụ</th>
                   
                    </tr>
                </thead>
                <tbody>
                   
						
                    @php
                        $total=0;
                    @endphp
                    @foreach ($order_detail as $key =>$v_order_detail )
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo "<div class='alert alert-success'>$message</div>";
                        Session::put('message', null);
                    }
                    $product = DB::table('tbl_product') -> where('tbl_product.product_id', $v_order_detail->product_id)->get();
					foreach ($product as $slug => $pro_slug) {
						    Session::put('product_slug',$pro_slug->product_slug);
						    $product_slug=Session::get('product_slug');
						}
					$subtotal = $v_order_detail-> product_price*$v_order_detail-> product_quantity;
					$total += $subtotal;
                    ?>
                    
                    <tr>
                        <td class=" p-0" >
                            <a href="{{URL::to('/san-pham/'.$product_slug)}}" style="padding: 1.3rem 1rem;">
                               <img style="height: 100px;" src="{{asset('public/upload/'.$v_order_detail-> product_image)}}" alt="">  
                            </a>
                        </td>
                        <td class=" p-0" >
                            <a href="{{URL::to('/san-pham/'.$product_slug)}}" style="padding: 1.3rem 1rem; color: #777;">
                                {{($v_order_detail -> product_name)}}
                            </a>
                        </td>
                        <td class=" p-0" >
                            <p style="padding: 1.3rem 1rem;">
                                {{($v_order_detail -> product_quantity)}}
                            </p>
                        </td>
                        <td class=" p-0" >
                            <p style="padding: 1.3rem 1rem;">
                                {{($v_order_detail -> product_price)}}
                            </p>
                        </td>
                        <td class=" p-0" >
                            <p style="padding: 1.3rem 1rem;">
                                {{number_format($subtotal,0,',','.')}}đ
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="mt-0 mb-3 pb-2" />
        <div>
            <div class="col-lg-6 float-right">
				<div class="cart-summary">
					<h3>TỔNG ĐƠN HÀNG</h3>

					<table class="table table-totals">
						<tbody>
							<tr>
								<td>Giá gốc</td>
								<td>{{number_format($total,0,',','.')}}đ</td>
							</tr>
							

							<tr>
								<td>Tiền ship</td>
								<td>{{number_format($history_order -> shipping_fee,0,',','.')}}đ</td>
							</tr>
                            <tr>
								<td>Trạng thái</td>
								<td>{{($history_order -> order_status)}}</td>
							</tr>
						</tbody>

						<tfoot>
							<tr>
								<td>Tổng tiền</td>
								<td>{{number_format($history_order -> order_total,0,',','.')}}đ</td>
								
							</tr>
							
						</tfoot>
														
					</table>
                    @if ($history_order -> order_status=='Đang chờ xử lý')
                    <div class="checkout-methods d-flex">
                        <div class="col-lg-12">
                            <a onclick="return confirm('Bạn có chắc muốn huỷ đơn hàng ?')" href="{{URL::to('/cancel-order/'.$history_order -> order_id)}}"class="btn btn-block btn-danger col-lg-12"><i class="fa fa-times "></i> Huỷ đơn</a>
                        </div>
                    </div>
                    @elseif($history_order -> order_status=='Đặt thành công, Đang giao hàng')
                    <div class="checkout-methods d-flex">
                        <div class="col-lg-12">
                            <a onclick="return confirm('Bạn có chắc muốn xác nhận đã nhận hàng, sau khi xác nhận không thể hoàn tác !')" href="{{URL::to('/checked-order/'.$history_order -> order_id)}}"class="btn btn-block btn-primary col-lg-12"><i class="fa fa-check"></i> Đã nhận</a>
                        </div>
                    </div>
                    @elseif($history_order -> order_status=='Đã huỷ')
                    @endif
                    {{-- @if ($history_order -> order_status=='Đã huỷ' || $history_order -> order_status=='Đã nhận hàng' ||$history_order -> order_status=='Đặt thành công, Đang giao hàng')
                                
                    @else
					<div class="checkout-methods d-flex">
                        <div class="col-lg-6">
                            <a onclick="return confirm('Bạn có chắc muốn xác nhận đã nhận hàng, sau khi xác nhận không thể hoàn tác !')" href="{{URL::to('/checked-order/'.$history_order -> order_id)}}"class="btn btn-block btn-primary col-lg-12"><i class="fa fa-check"></i> Đã nhận</a>
                        </div>
                        <div class="col-lg-6">
                            <a onclick="return confirm('Bạn có chắc muốn huỷ đơn hàng ?')" href="{{URL::to('/cancel-order/'.$history_order -> order_id)}}"class="btn btn-block btn-danger col-lg-12"><i class="fa fa-times "></i> Huỷ đơn</a>
                        </div>
                    </div>
                    @endif --}}
                </div><!-- End .cart-summary -->
			</div>
            <div class="col-lg-6 float-left">
				<div class="cart-summary">
					<h3>THÔNG TIN ĐƠN HÀNG</h3>

					<table class="table table-totals">
						<tbody>
							<tr>
								<td>Tên người nhận:</td>
								<td>{{($history_order -> shipping_name)}}</td>
							</tr>
							
							<tr>
								<td>Địa chỉ:</td>
								<td style="width: 60%;">{{($history_order -> shipping_address)}}</td>
							</tr>
							<tr>
								<td>Số điện thoại:</td>
								<td>{{($history_order -> shipping_phone)}}</td>
							</tr>
                            <tr>
								<td>Phương thức:</td>
								<td>{{($history_order -> payment_method)}}</td>
							</tr>
                            <tr>
								<td>Trạng thái:</td>
								<td>{{($history_order -> payment_status)}}</td>
							</tr>
                            <tr>
								<td>Ghi chú:</td>
								<td>{{($history_order -> shipping_note)}}</td>
							</tr>
                            @php
                                use Carbon\Carbon;
                            @endphp
                            <tr>
								<td>Ngày đặt:</td>
								<td>{{ $history_order->created_at ? Carbon::parse($history_order->created_at)->format('H:i d/m/Y') : 'N/A' }}</td>
							</tr>
						</tbody>

						
														
					</table>
                    
                </div><!-- End .cart-summary -->
			</div>
        </div>
            
        </div>
    </div>
</div>
@endsection