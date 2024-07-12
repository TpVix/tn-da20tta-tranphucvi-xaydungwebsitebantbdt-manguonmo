@extends('admin_layout')
@section('main_admin')

<div class="content">
  <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
    <h1>Danh sách đánh giá</h1>
    
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <?php
           $acept_comment = Session::get('acept_comment');
           $delete_comment = Session::get('delete_comment');
            
           if ($acept_comment) {
                 echo "<div class='alert alert-success'>$acept_comment</div>";
                 Session::put('acept_comment', null);
               }
               if ($delete_comment) {
                 echo "<div class='alert alert-danger'>$delete_comment</div>";
                 Session::put('delete_comment', null);
               }
          ?>
        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="table table_data" style="width:100%">
              <thead>
                <tr>
                  
                  <th>Tài khoản</th>
                  <th style="width:35%">Bình luận</th>
                  <th style="width:38%">Sản phẩm</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($list_comment as $key => $v_list_comment)
                @php
                    $customer = DB::table('tbl_customers')->where('customer_id', $v_list_comment->customer_id)->first();
                    $product = DB::table('tbl_product')->where('product_id', $v_list_comment->product_id)->first();
                @endphp
                <tr>
                  <td> {{ $customer -> customer_name}}</td>
                  <td> {{ $v_list_comment -> comment}}</td>
                  <td> {{ $product -> product_name}}</td>
                  <td> {{ $v_list_comment -> comment_status}}</td>
                  <td>

                    <div class="btn-group">
                                                    
                                                      
                      <a href="{{url('/acept-comment/'.$v_list_comment->comment_id)}}" class="btn btn-outline-success">Duyệt</a>
                      <a href="{{url('/delete-comment/'.$v_list_comment->comment_id)}}" class="btn btn-outline-success">Xoá</a>
                     
                  </div>
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