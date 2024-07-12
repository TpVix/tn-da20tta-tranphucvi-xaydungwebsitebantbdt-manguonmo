@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>Danh sách tài khoản</h1>
                
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"> Thêm nhân viên
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $delete_account = Session::get('delete_account');
                            $permisstion = Session::get('permisstion');
                            if ($delete_account || $permisstion) {
                                echo "<div class='alert alert-success'>$delete_account$permisstion</div>";
                                Session::put('delete_account', null);
                                Session::put('permisstion', null);
                            }
                            ?>
                            <table id="" class="table table_data">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;!important"></th>
                                        <th>Tên</th>
                                        <th style="text-align: left;!important">Số điện thoại</th>
                                        <th>Quyền</th>

                                        <th>Ngày tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        use Carbon\Carbon;
                                    @endphp
                                    @foreach ($admin_admin_role as $all)
                                        <tr>



                                            <td><img class="vendor-thumb"
                                                    src="{{ asset('public/backend/assets/img/vendor/u8.jpg') }}"
                                                    alt="user profile" /></td>
                                            <td>{{ $all->admin_name }}</td>
                                            <td>{{ $all->admin_phone }}</td>


                                            <td>
                                                {{ $all->role_name }}

                                            </td>
                                            <td>{{ $all->created_at ? Carbon::parse($all->created_at)->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td>
                                                <div style="position: relative;" class=" mb-1">

                                                    <button type="button" class="btn btn-outline-success dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-display="static">
                                                        Phân quyền
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        @foreach ($all_role as $v_all_role)
                                                            <form
                                                                action="{{ URL::to('/permisstion/' . $v_all_role->role_id) }}"
                                                                method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="admin_id"
                                                                    value="{{ $all->admin_id }}">
                                                                <input type="submit" class="dropdown-item"
                                                                    value="{{ $v_all_role->role_name }}" />

                                                            </form>
                                                        @endforeach

                                                    </div>



                                                    <a class="btn btn-outline-danger"
                                                        href="{{ URL::to('/delete-account/' . $all->admin_id) }}">Xoá</a>
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
        <!-- Add User Modal  -->
        <div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ URL::to('/save-admin') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Thêm tài khoản</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-default">

                                        <div class="card-body">
                                            <div class="row ec-vendor-uploads">
                                                <div class="col-lg-5">
                                                    <div class="ec-vendor-img-upload">
                                                        <div class="ec-vendor-main-img">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input type='file' id="imageUpload"
                                                                        name="admin_image" class="ec-image-upload"
                                                                        accept=".png, .jpg, .jpeg" />
                                                                    <label for="imageUpload"><img
                                                                            src="{{ asset('public/backend/assets/img/icons/edit.svg') }}"
                                                                            class="svg_img header_svg"
                                                                            alt="edit" /></label>
                                                                </div>
                                                                <div class="avatar-preview ec-preview">
                                                                    <div class="imagePreview ec-div-preview">
                                                                        <img class="ec-image-preview"
                                                                            src="{{ asset('public/backend/assets/img/products/vender-upload-preview.jpg') }}"
                                                                            alt="edit" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="ec-vendor-upload-detail">

                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Tên đăng
                                                                nhập</label>
                                                            <input type="text" name="admin_name"
                                                                class="form-control slug-title" id="inputEmail4">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Số điện
                                                                thoại</label>
                                                            <input type="text" name="admin_phone"
                                                                class="form-control slug-title" id="inputEmail4">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Mật khẩu</label>
                                                            <input type="password" name="admin_password"
                                                                class="form-control slug-title" id="inputEmail4">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputEmail4" class="form-label">Quyền</label>
                                                            <select name="role_id" class="form-select">
                                                                @foreach ($all_role as $v_all_role)
                                                                    <option value="{{ $v_all_role->role_id }}">
                                                                        {{ $v_all_role->role_name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-1 text-right">
                                                            <button type="submit" class="btn btn-primary">Tạo</button>
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
