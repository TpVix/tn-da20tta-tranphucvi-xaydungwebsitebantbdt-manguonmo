@extends('admin_layout')
@section('main_admin')


<div class="content">
  <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
    <div>
      <h1>Sản phẩm</h1>
      
    </div>
    
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <?php
           $message = Session::get('message');
            if ($message) {
                 echo "<div class='alert alert-success'>$message</div>";
                 Session::put('message', null);
               }
          ?>
        <div class="card-body">
          
          <div class="table-responsive ">
            <table id="" class="table table_data"
              style="width:100%">
              <thead>
                <tr>
                  <th>Hình ảnh</th>
                  <th style="width:20%;">Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
               
                  <th>Tên danh mục</th>
                  <th>Tên thương hiệu</th>
                  <th>Nhân viên</th>
                  <th>Hành động</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($all_product as $key => $product)
                <tr>
                  <td><img src="{{ url('public/upload/' . $product->product_image) }}" height="100" width="100" alt=""></td>
              <td>{{ $product -> product_name}}</td>
              <td>{{ $product -> product_quantity}}</td>
              <td>{{ $product -> product_price}}</td>
            
              <td>
                @if ($product -> category_name == '')
                    Phụ kiện
                @else
                {{ $product -> category_name}}
                @endif
                
              
              </td>
              <td>{{ $product -> brand_name}}</td>
              <td>{{ $product -> admin_name}}</td>
              <td style="text-align: center;">
              <div
              style="
                  height: 100%;
                  display: flex;
                  align-items: center;
                  
                  justify-content: center;
              "
              >
                <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="btn btn-outline-success" ui-toggle-class="">
                   Sửa <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="btn btn-outline-danger" ui-toggle-class="">
                  Xoá  <i class="fa fa-times text-danger text"></i>
                </a>
              </div>
                <a href="{{URL::to('/add-image/'.$product->product_id)}}" class="btn btn-outline-success mt-1" ui-toggle-class="">
                  Thêm ảnh <i class="fa fa-pencil-square-o text-success text-active"></i>
               </a>
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
</div> 
  
@endsection