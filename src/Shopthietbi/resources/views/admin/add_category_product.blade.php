@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Danh mục</h1>
           
        </div>
        <div class="ec-cat-list card card-default mb-24px" id="addUser" tabindex="-1" role="dialog">
            <div class=" modal-dialog-centered " role="document">
                <div class="col-lg-12" >
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo "<div class='alert alert-success'>$message</div>";
                        Session::put('message', null);
                    }
                    ?>

                    <form role="form" id="form-all" action="{{ URL::to('/save-category-product') }}" method="post">
                        {{ csrf_field() }}

                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Thêm danh mục</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ec-cat-list card card-default mb-24px">

                                        <div class="card-body">
                                            <div class="row ec-vendor-uploads">
                                                
                                                <div class="col-lg-12">
                                                    <div class="ec-vendor-upload-detail">

                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Tên danh mục</label>
                                                            <input type="text" data-validation="required"
                                                                data-validation-error-msg="Tên danh mục không được để trống"
                                                                name="category_product_name" class="form-control slug-title"
                                                                id="inputEmail4">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Đường dẫn</label>
                                                            <input type="text" data-validation="required"
                                                                data-validation-error-msg="Đường dẫn không được để trống"
                                                                name="category_product_slug" class="form-control slug-title"
                                                                id="inputEmail4">
                                                        </div>
                                                        {{-- <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Từ khoá</label>
                                                            <input type="text" data-validation="required"
                                                                data-validation-error-msg="Từ khoá không được để trống"
                                                                name="category_product_keyword" class="form-control slug-title"
                                                                id="inputEmail4">
                                                        </div> --}}
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Nhóm phụ kiện</label>
                                                            <select name="accessory_id" class="form-select">
                                                                @foreach ($all_accessory as $v_all_accessory)
                                                                    
                                                                <option value="{{$v_all_accessory->accessory_id}}">{{$v_all_accessory->accessory_name}}</option>
                                                                
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Trạng thái</label>
                                                            <select name="category_product_status" class="form-select">
                                                                <option value="0">Ẩn</option>
                                                                <option value="1">Hiện</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-1 text-right">
                                                            <button name="submit" type="submit"
                                                                class="btn btn-primary">Thêm</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection
