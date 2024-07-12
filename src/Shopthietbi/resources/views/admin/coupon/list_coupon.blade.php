@extends('admin_layout')
@section('main_admin')

<div class="content">
  <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
          <h1>Danh sách mã giảm giá</h1>
          
  </div>
  <div class="row">
<div class="col-12">
  <div class="ec-cat-list card card-default">
      <div class="card-body">
          <div class="table-responsive">
              <table id="" class="table table_data">
                <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo "<div class='alert alert-success'>$message</div>";
                            Session::put('message', null);
                        }
                        ?>
                  <thead>
                      <tr>
                         
                          <th>Tên</th>
                          
                          <th>Mã</th>
                          <th>Số lượng</th>
                          <th>% hoặc tiền</th>
                          <th>Số</th>
                          <th>Hành động</th>
                      </tr>
                  </thead>

                  <tbody>
                    @foreach ($coupon as $key => $coupon)


                      <tr>
                         
                          <td> {{ $coupon -> coupon_name}}</td>

                          
                          <td> {{ $coupon -> coupon_code}}</td>
                         
                          <td> {{ $coupon -> coupon_qty}}</td>
              
                            <?php
                            if ($coupon->coupon_option == 0) {
                                echo '<td>Giảm theo %</td>';
                            } else {
                                echo '<td>Giảm theo tiền</td>';
                            }
                            ?>
                          <td> {{ $coupon -> coupon_number}}</td>
              
                          
                            <td>
                           
                              <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" class="btn btn-outline-danger" ui-toggle-class="">
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