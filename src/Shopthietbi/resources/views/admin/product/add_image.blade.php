@extends('admin_layout')
@section('main_admin')
<div class="content">
    <form role="form" id="form-all" action="{{URL::to('/save-image')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Thêm hình ảnh</h1>
               
            </div>
        
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Thêm hình ảnh</h2>
                    </div>
                    


                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo "<div class='alert alert-success'>$message</div>";
                        Session::put('message', null);
                    }

                    $product_id = Session::get('product_id');
                    ?>
                    <div class="card-body">
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-4">
                                <div class="ec-vendor-img-upload">
                                    <div class="ec-vendor-main-img">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="product_image" class="ec-image-upload"
                                                    accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"><img
                                                        src="{{asset('public/backend/assets/img/icons/edit.svg')}}"
                                                        class="svg_img header_svg" alt="edit" /></label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    <img class="ec-image-preview"
                                                        src="{{asset('public/backend/assets/img/products/vender-upload-preview.jpg')}}"
                                                        alt="edit" />
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-primary">Thêm </button>
                                        </div>
                                    </div>
                                </div>
                               
                            </div> 
                            
                            <div class="col-lg-8">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                           
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        @foreach ($product_image as $product_image)
                                            
                                       
                                        <tr>

    
                                            <td><img src="{{URL::to('public/upload/product_image/'.$product_image -> image_url)}}" height="100" width="100" alt=""></td>
                                           
                                            <td>{{$product_image->product_name}}</td>
                                            <td >
                                            <a href="{{URL::to('/edit-image/'.$product_image->image_id)}}" class="btn btn-outline-success mt-1" ui-toggle-class="">
                                                Sửa <i class="fa fa-pencil-square-o text-success text-active"></i>
                                             </a>
                                             <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-image/'.$product_image->image_id)}}" class="btn btn-outline-danger mt-1" ui-toggle-class="">
                                                Xoá <i class="fa fa-pencil-square-o text-danger text-active"></i>
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
    </form>
</div>
@endsection