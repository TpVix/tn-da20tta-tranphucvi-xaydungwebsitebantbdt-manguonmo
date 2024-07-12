@extends('admin_layout')
@section('main_admin')

<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Thương hiệu</h1>
            
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Chỉnh sửa thương hiệu</h4>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo "<div class='alert alert-success'>$message</div>";
                            Session::put('message', null);
                        }
                    ?>
                     @foreach ($edit_brand_product as $key => $edit_brand)
                     <form role="form" action="{{URL::to('/update-brand/'.$edit_brand -> brand_id)}}" method="post">
                        {{ csrf_field() }}


                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Tên</label> 
                                <div class="col-12">
                                    <input type="text" value="{{$edit_brand -> brand_name}}" data-validation="required" data-validation-error-msg="Tên thương hiệu không được để trống" name="brand_product_name" class="form-control here slug-title" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-12 col-form-label">Đường dẫn</label> 
                                <div class="col-12">                       
                                    <input type="text" value="{{$edit_brand -> brand_slug}}" data-validation="required" data-validation-error-msg="Đường dẫn không được để trống" name="brand_product_slug" class="form-control here set-slug" id="exampleInputEmail1" placeholder="Đường dẫn thương hiệu">

                                </div>
                            </div>

                           
                            <div class="row">
                                <div class="col-12">
                                    <button name="submit" type="submit" class="btn btn-primary">Sửa</button>
                                </div>
                            </div>

                        </form>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</div>
@endsection