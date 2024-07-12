@extends('admin_layout')
@section('main_admin')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>mã giảm giá</h1>
           
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Thêm mã giảm giá</h4>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo "<div class='alert alert-success'>$message</div>";
                            Session::put('message', null);
                        }
                    ?>
                        <form role="form" id="form-all" action="{{URL::to('/save-coupon')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Tên</label> 
                                <div class="col-12">
                                    <input type="text" data-validation="required" data-validation-error-msg="Tên mã giảm giá không được để trống" name="coupon_name" class="form-control here slug-title" id="exampleInputEmail1" placeholder="Tên mã giảm giá">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Mã</label> 
                                <div class="col-12">
                                    <input type="text" data-validation="required" data-validation-error-msg="Mã giảm giá không được để trống" name="coupon_code" class="form-control here slug-title" id="exampleInputEmail1" placeholder="Mã giảm giá">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Số lượng</label> 
                                <div class="col-12">
                                    <input type="text" data-validation="required" data-validation-error-msg="Số lượng mã giảm giá không được để trống" name="coupon_qty" class="form-control here slug-title" id="exampleInputEmail1" placeholder="Số lượng mã giảm giá">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-form-label">Tính năng mã</label> 
                                <select name="coupon_option" class="form-control"style="
                                width: 93.5%;
                                margin-left: 12px;
                            ">
                                    <option value="0">Giảm theo %</option>
                                    <option value="1">Giảm theo tiền</option>
                                </select>
        
                            </div>  
                            <div class="form-group row">
                                <label class="col-12 col-form-label">Nhập số % hoặc số tiền giảm</label> 
                                <div class="col-12">
        
                                    <input type="text" data-validation="required" data-validation-error-msg="không được để trống" name="coupon_number" class="form-control here slug-title" id="exampleInputEmail1" placeholder="% hoặc số tiền cụ thể">

                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-12">
                                    <button name="submit" type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
      
    </div>
</div>

@endsection