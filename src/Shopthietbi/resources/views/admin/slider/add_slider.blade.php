@extends('admin_layout')
@section('main_admin')
<div class="content">
    <form role="form" id="form-all" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Thêm Slider</h1>
           
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Thêm Slider</h2>
                </div>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo "<div class='alert alert-success'>$message</div>";
                    Session::put('message', null);
                }
                ?>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        <div class="col-lg-9">
                            <div class="ec-vendor-img-upload">
                                <div class="ec-vendor-main-img">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="slider_image" class="ec-image-upload"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><img
                                                    src="{{asset('public/backend/assets/img/icons/edit.svg')}}"
                                                    class="svg_img header_svg" alt="edit" /></label>
                                        </div>
                                        <div class="avatar-preview ec-preview">
                                            <div class="imagePreview ec-div-preview">
                                                <img style="height: 300px; !important
                                                            width:100%; !important
                                                " class="ec-image-preview"
                                                    src="{{asset('public/backend/assets/img/products/vender-upload-preview.jpg')}}"
                                                    alt="edit" />
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ec-vendor-upload-detail">
                               
                                    <div class="col-md-12">
                                        <label class="form-label">Chọn loại</label>
                                        <select name="slider_option" id="Categories" class="form-select">
                                                <option value="1">Slider lớn</option>
                                                <option value="2">Slider ngắn</option>
                                                <option value="3">Banner sản phẩm</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Trạng thái</label>
                                        <select name="slider_status" id="Categories" class="form-select">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiện</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-12 text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Thêm Slider</button>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div> 
@endsection