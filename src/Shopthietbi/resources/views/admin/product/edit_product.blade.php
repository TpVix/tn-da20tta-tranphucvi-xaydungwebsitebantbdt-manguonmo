@extends('admin_layout')
@section('main_admin')

<div class="content">
    @foreach ($edit_product as $key => $edit_product)
    <form role="form" id="form-all" action="{{URL::to('/update-product/'.$edit_product -> product_id)}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Thêm sản phẩm</h1>
                
            </div>
        
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Thêm sản phẩm</h2>
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
                                                        src="{{URL::to('public/upload/'.$edit_product -> product_image)}}"
                                                        alt="edit" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload-set colo-md-12">
                                            @foreach ($product_image as $product_image)
                                                
                                            <div class="thumb-upload">
                                            
                                                <div class="thumb-preview ec-preview">
                                                    <div class="image-thumb-preview">
                                                        <img class="image-thumb-preview ec-image-preview"
                                                            src="{{URL::to('public/upload/product_image/'.$product_image -> image_url)}}"
                                                            alt="edit" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            
                                        </div>
                                        <a href="{{URL::to('/add-image/'.$edit_product->product_id)}}" class="btn btn-outline-success mt-1" ui-toggle-class="">
                                            Sửa ảnh<i class="fa fa-pencil-square-o text-success text-active"></i>
                                         </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                               
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Tên sản phẩm</label>
                                            <input type="text" data-validation="required" data-validation-error-msg="Tên sản phẩm không được để trống" value="{{($edit_product -> product_name)}}" name="product_name" class="form-control slug-title" id="exampleInputEmail1" placeholder="Tên sản phẩm">

                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Số lượng</label>
                                            <input type="text" data-validation="number" data-validation-error-msg="Số lượng phải là số và không được để trống"  value="{{($edit_product -> product_quantity)}}" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">

                                        </div>
                                        <div class="col-md-6">
                                        <label class="form-label">Danh mục</label>
                                        
                                        <select name="category_id" class="form-select">
                                            <option value="0">
                                                --Chọn danh mục--</option>
                                            @foreach ($category as $cate)
                                        @if ($cate->category_id == $edit_product->category_id)
                                            <option value="{{ $cate->category_id }}" selected>{{ $cate->category_name }}</option>
                                        @else
                                            <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                        @endif
                                    @endforeach

            
                                        </select>
            
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Thương hiệu</label>
                                
                                        <select name="brand_id" class="form-select">
                                            @foreach ($brand as $key => $brand)
                                            @if ($brand-> brand_id == $edit_product-> brand_id)
                                                <option value="{{ $brand-> brand_id }}" selected>{{ $brand -> brand_name }}</option>
                                            @else
                                                <option value="{{($brand -> brand_id)}}">{{($brand -> brand_name)}}</option>
                                            @endif
                                        @endforeach
        
                                                
                                        </select>
            
                                    </div>
                                        <div class="col-md-12">
                                            <label for="slug" class="col-12 col-form-label">Đường dẫn</label> 
                                            <div class="col-12">
                                                <input  value="{{($edit_product -> product_slug)}}" data-validation="required" data-validation-error-msg="Đường dẫn không được để trống" type="text" name="product_slug" class="form-control here set-slug" id="exampleInputEmail1" placeholder="Đường dẫn sản phẩm">

                                            </div>
                                        </div>
                    
                                        
                                        <div class="col-md-8 mb-25">
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Giá </label>                                    
                                            <input type="text" data-validation="number" data-validation-error-msg="Giá phải là số và không được để trống" value="{{($edit_product -> product_price)}}" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">

                                        </div>
                                       
                                
                                        <div class="col-md-12">
                                            <label class="form-label">Mô tả</label>
                                            <textarea class="form-control" rows="4" name="product_desc" id="editor2">{{($edit_product -> product_desc)}}</textarea>

                                        </div>
                                        

                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        
    </form>
    @endforeach 
</div>
@endsection