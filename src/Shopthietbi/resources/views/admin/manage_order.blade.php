@extends('admin_layout')
@section('main_admin')

<div class="content">
  <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
    <h1>Tổng đơn hàng</h1>
    
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="table table_data" style="width:100%">
              <thead>
                <tr>
                  <th>Mã đơn hàng</th>
                  <th>Tên đơn hàng</th>
                  <th>Tên người mua</th>
                  <th>Tổng số lượng</th>
                  <th>Tổng giá tiền</th>
                  <th>Tình trạng</th>
                  <th style="width:12%;">Địa chỉ</th>
                  <th>Số điện thoại</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($all_order as $key => $all_order)

                <tr>
                  <td> {{ $all_order -> order_id}}</td>
                  <td> {{ $all_order -> order_name}}</td>
                  <td> {{ $all_order -> shipping_name}}</td>
                  <td> {{ $all_order -> order_quantity}}</td>
                  <td> {{ $all_order -> order_total}}</td>
                  <td> {{ $all_order -> order_status}}</td>
                  <td> {{ $all_order -> shipping_address}}</td>
                  <td> {{ $all_order -> shipping_phone}}</td>
                  <td>
                    
                    <a href="{{URL::to('/view-order/'.$all_order->order_id)}}" class="btn btn-outline-success" ui-toggle-class="">
                      Xem <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>
                  
                    {{-- <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-order/'.$all_order->order_id)}}" class="btn btn-outline-danger" ui-toggle-class="">
                      Xoá  <i class="fa fa-times text-danger text"></i>
                    </a> --}}
                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!--  
@endsection