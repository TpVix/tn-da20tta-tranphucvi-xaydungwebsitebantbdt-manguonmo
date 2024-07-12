@extends('admin_layout')
@section('main_admin')


<div class="content">
  <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
    <div>
      <h1>Danh sách Slider</h1>
      
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
          
          <div class="table-responsive">
            <table id="" class="table table_data"
              style="width:100%">
              <thead>
                <tr>
                  <th style="text-align: left;">Hình ảnh</th>
                  <th>Loại</th>
                  <th>Trạng thái</th>
                  <th>Hành động</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($all_slider as $key => $slider)
                <tr>
                  <td style="text-align: left;"><img src="public/upload/banner/{{ $slider -> slider_image}}" height="180px" width="600px" alt=""></td>
              <td>
                <?php
                if ($slider->slider_option == 1) {
                    echo '<a class="badge badge-success" href="' . URL::to('/change-option/' . $slider->slider_id) . '">Slider lớn</a>';
                } else if($slider->slider_option == 2) {
                    echo '<a class="badge badge-success" href="' . URL::to('/change-option/' . $slider->slider_id) . '">Slider ngắn</a>';
                } else {
                    echo '<a class="badge badge-success" href="' . URL::to('/change-option/' . $slider->slider_id) . '">Banner sản phẩm</a>';

                }
                ?>
                </td>
              <td>
                <?php
                if ($slider->slider_status == 0) {
                    echo '<a class="badge badge-danger" href="' . URL::to('/status-slider/' . $slider->slider_id) . '">Ẩn</a>';
                } else {
                    echo '<a class="badge badge-success" href="' . URL::to('/status-slider/' . $slider->slider_id) . '">Hiện</a>';
                }
                ?>

              </td>

              <td>
                <a href="{{URL::to('/edit-slider/'.$slider->slider_id)}}" class="btn btn-outline-success" ui-toggle-class="">
                   Sửa <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-slider/'.$slider->slider_id)}}" class="btn btn-outline-danger" ui-toggle-class="">
                  Xoá  <i class="fa fa-times text-danger text"></i>
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