@extends('admin_layout')
@section('main_admin')

<div class="content">
  <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
    <h1>Danh sách đánh giá</h1>
    
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="table table_data" style="width:100%">
              <thead>
                <tr>
                  
                  <th>Tên khách hàng</th>
                  <th style="width:38%">Bình luận</th>
                  <th>Đánh giá</th>
                  <th style="width:38%">Sản phẩm</th>
                  
                </tr>
              </thead>

              <tbody>
                @foreach ($list_review as $key => $v_list_review)
                @php
                    $customer = DB::table('tbl_customers')->where('customer_id', $v_list_review->customer_id)->first();
                    $product = DB::table('tbl_product')->where('product_id', $v_list_review->product_id)->first();
                @endphp
                <tr>
                  <td> {{ $customer -> customer_name}}</td>
                  <td> {{ $v_list_review -> rating_review}}</td>
                  <td> {{ $v_list_review -> rating_start}} sao</td>
                  <td> {{ $product -> product_name}}</td>
                 
                 

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