@extends('admin_layout')
@section('main_admin')

<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Thông tin cá nhân</h1>
            
        </div>
    </div>
    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            <img src="{{asset('public/upload/avt_admin/icon_avt.jpg')}}" alt="">
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{$admin->admin_name}}</h4>
                           
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Thông tin</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Số điện thoại</p>
                        <p>{{$admin->admin_phone}}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Ngày tạo</p>
                        <p>{{$admin->created_at}}</p>
                        
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right profile-right-spacing py-5">
                    <?php
                    $success = Session::get('success');
                    $danger = Session::get('danger');
                    if ($success) {
                        echo "<div class='alert alert-success'>$success</div>";
                        Session::put('success', null);
                    }
                    if ($danger) {
                        echo "<div class='alert alert-danger'>$danger</div>";
                        Session::put('danger', null);
                    }
                   
                    ?>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                        <div id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                

                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Tên đăng nhập</label>
                                                <input type="text" class="form-control" readonly id="firstName"
                                                    value="{{$admin->admin_name}}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="lastName">Quyền hạn</label>
                                                <input type="text" class="form-control" readonly id="lastName"
                                                    value="{{$admin->role_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{url('/update-phone/'.$admin->admin_id)}}" method="post">
                                        @csrf
                                    <div class="form-group mb-4">
                                        <label for="email">Số điện thoại</label>
                                        <input class="form-control" name="admin_phone" id="email"
                                            value="{{$admin->admin_phone}}">
                                    </div>
                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit"
                                            class="btn btn-primary mb-2 btn-pill">Cập nhật số điện thoại</button>
                                    </div>
                                    </form>
                                    <form action="{{url('/update-profile/'.$admin->admin_id)}}" method="post">
                                        @csrf
                                    <div class="form-group mb-4">
                                        <label for="oldPassword">Mật khẩu cũ</label>
                                        <input type="password" name="old_password" class="form-control" id="oldPassword">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="newPassword">Mật khẩu mới</label>
                                        <input type="password" name="new_password" class="form-control" id="newPassword">
                                    </div>

                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit"
                                            class="btn btn-primary mb-2 btn-pill">Cập nhật mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection