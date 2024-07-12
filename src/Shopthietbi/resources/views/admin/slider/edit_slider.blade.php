@extends('admin_layout')
@section('main_admin')
<div class="content">
    <form role="form" id="form-all" action="{{URL::to('/update-slider/'.$edit_slider->slider_id)}}" method="post" enctype="multipart/form-data">
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
                                                    src="{{URL::to('public/upload/banner/'.$edit_slider -> slider_image)}}"
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
                                            @php
                                                if ($edit_slider->slider_option == 1) {
                                                    echo '<option value="1" selected>Slider lớn</option>';
                                                    echo '<option value="2">Slider ngắn</option>';
                                                    echo ' <option value="3">Banner sản phẩm</option>';
                                                }elseif ($edit_slider->slider_option == 2) {
                                                    echo '<option value="1">Slider lớn</option>';
                                                    echo '<option value="2" selected>Slider ngắn</option>';
                                                    echo ' <option value="3">Banner sản phẩm</option>';
                                                }else {
                                                    echo '<option value="1">Slider lớn</option>';
                                                    echo '<option value="2">Slider ngắn</option>';
                                                    echo ' <option value="3" selected>Banner sản phẩm</option>';
                                                }
                                            @endphp
                                    
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Trạng thái</label>
                                        <select name="slider_status" id="Categories" class="form-select">
                                            @php
                                            if ($edit_slider->slider_status == 0) {
                                                echo '<option value="0" selected>Ẩn</option>';
                                                echo '<option value="1">Hiện</option>';
                                            
                                            }else {
                                                echo '<option value="0">Ẩn</option>';
                                                echo '<option value="1" selected>Hiện</option>';
                                            }
                                        @endphp
                                            
                                            
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-12 text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Sửa Slider</button>
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