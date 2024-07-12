@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Chương trình khuyến mãi</h1>
            
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Thêm khuyến mãi</h4>
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo "<div class='alert alert-success'>$message</div>";
                                Session::put('message', null);
                            }
                            ?>
                            <form action="{{ URL::to('/save-promotion') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Tên</label>
                                    <div class="col-12">
                                        <input id="text" name="promotion_name" class="form-control here slug-title"
                                            type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-form-label">Mô tả</label>
                                    <div class="col-12">
                                        <textarea id="sortdescription" name="promotion_des" cols="40" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Giá khuyến mãi</label>

                                    <div class="col-12">
                                        <input id="text" name="promotion_price" class="form-control here slug-title"
                                            type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Loại khuyến mãi</label>
                                    <select name="promotion_option" class="form-select">
                                        <option value="%">
                                            --%--</option>
                                        <option value="VNĐ">
                                            --VNĐ--</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label"><input style="width: 20px;"
                                            type="checkbox" name="brand_checkbox" value="Theo thương hiệu" id=""> Theo thương hiệu</label>
                                </div>
                                <div class="form-group row" id="brand_form" hidden>
                                    <label for="text" class="col-12 col-form-label">Thương hiệu khuyến mãi</label>
                                    <select name="brand_name" class="form-select">
                                        <option value="" selected>
                                            --Chọn thương hiệu--</option>
                                        @foreach ($brand as $key => $brand)
                                            <option value="{{ $brand->brand_name }}">
                                                {{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Khuyến mãi</label>
                                    <select name="promotion_status" class="form-select">
                                        <option value="Có">
                                            Có</option>
                                        <option value="Không">
                                            Không</option>
                                    </select>
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
            <div class="col-xl-8 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        <?php
                            $delete = Session::get('delete');
                            if ($delete) {
                                echo "<div class='alert alert-success'>$delete</div>";
                                Session::put('delete', null);
                            }
                            ?>
                        <div class="table-responsive">
                            <table class="table table_data">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                        <th>Thương hiệu</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Loại</th>
                                        <th>Khuyến mãi</th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($promotion as $v_promotion)
                                        <tr>

                                            <td>{{ $v_promotion->promotion_name }}</td>

                                            <td>{{ $v_promotion->promotion_des }}</td>
                                            <td>
                                                @if ($v_promotion->brand_name == '')
                                                    Không có
                                                @else
                                                {{ $v_promotion->brand_name }}
                                                @endif
                                                
                                            </td>
                                            <td>{{ $v_promotion->promotion_price }}</td>
                                            <td>{{ $v_promotion->promotion_option }}</td>
                                            <td>
                                                @if ($v_promotion->promotion_status == "Có")
                                                <span
                                                class="badge badge-success">{{ $v_promotion->promotion_status }}</span>
                                                @else
                                                <span
                                                class="badge badge-danger">{{ $v_promotion->promotion_status }}</span>  
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    
                                                      
                                                    <a href="{{url('/product-promotion/'.$v_promotion->promotion_id)}}" class="btn btn-outline-success">Chọn sản
                                                        phẩm</a>
                                                    
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-display="static">
                                                        <span class="sr-only">Info</span>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{url('/edit-promotion/'.$v_promotion->promotion_id)}}">Sửa</a>
                                                        <a class="dropdown-item" href="{{url('/delete-promotion/'.$v_promotion->promotion_id)}}">Xoá</a>
                                                    </div>
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
        
    </div>
@endsection
