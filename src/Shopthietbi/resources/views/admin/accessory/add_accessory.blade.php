@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Nhóm phụ kiện</h1>
            
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Thêm nhóm phụ kiện</h4>
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo "<div class='alert alert-success'>$message</div>";
                                Session::put('message', null);
                            }
                            ?>
                            <form action="{{ URL::to('/save-accessory') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Tên</label>
                                    <div class="col-12">
                                        <input id="text" name="accessory_name" class="form-control here slug-title"
                                            type="text" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Đường dẫn</label>
                                    <div class="col-12">
                                        <input id="text" name="accessory_slug" class="form-control here slug-title"
                                            type="text" required>
                                    </div>
                                </div>


                                
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Trạng thái</label>
                                    <select name="accessory_status" class="form-select">
                                        <option value="Hiện">
                                            Hiện</option>
                                        <option value="Ẩn">
                                            Ẩn</option>
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
                                        
                                        <th>Đường dẫn</th>
                                        <th>Trạng thái</th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($accessory as $v_accessory)
                                        <tr>

                                            <td>{{ $v_accessory->accessory_name }}</td>

                                            <td>{{ $v_accessory->accessory_slug }}</td>
                                    
                                            <td>
                                                @if ($v_accessory->accessory_status == "Hiện")
                                                <span
                                                class="badge badge-success">{{ $v_accessory->accessory_status }}</span>
                                                @else
                                                <span
                                                class="badge badge-danger">{{ $v_accessory->accessory_status }}</span>  
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    
                                                      
                                                    <a href="{{url('/product-accessory/'.$v_accessory->accessory_id)}}" class="btn btn-outline-success">Chọn sản
                                                        phẩm</a>
                                                    
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-display="static">
                                                        <span class="sr-only">Info</span>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{url('/edit-accessory/'.$v_accessory->accessory_id)}}">Sửa</a>
                                                        <a class="dropdown-item" href="{{url('/delete-accessory/'.$v_accessory->accessory_id)}}">Xoá</a>
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
