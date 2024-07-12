@extends('pages.layout.layout')
@section('content')
@php    
    $login_gg = Session::get('login_gg');
    $customer_id = Session::get('customer_id');
	$customer_name = Session::get('customer_name');
    $customer_email = Session::get('customer_email');
@endphp
<div id="edit" role="tabpanel">
    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
            class="icon-user-2 align-middle mr-3 pr-1"></i>Chi tiết tài khoản</h3>
    <div class="account-content">
        <form action="{{URL::to('/save-name/'.$customer_id)}}" method="POST">
           @csrf

            <div class="form-group mb-2">
                <label for="acc-text">Tên hiển thị <span class="required">*</span> </label>
                <div style="display: flex; align-items: center;"><input type="text" value="{{$customer_name}}" class="form-control" id="acc-text" name="customer_name"
                    placeholder="Editor" required /> 
                   
                        <button type="submit" style="margin-left: 10px; height: 50px; padding: 1em 1.6em;" class="btn btn-dark mr-0">
                            Lưu thay đổi
                        </button>
                    </div>
                <p>Tên được hiển thị bên ngoài giao diện</p>
                
            </div>

        </form>
            <div class="form-group mb-4">
                <label for="acc-email">Địa chỉ Email <span class="required">*</span></label>
                <input type="email" readonly class="form-control" value="{{$customer->customer_email}}" id="acc-email" name="acc-email"
                    placeholder="editor@gmail.com" required />
            </div>
            <div class="order-table-container form-group mb-4">
                <label for="acc-email">Thông tin giao hàng <span class="required">*</span></label>
                <table class="table table-order text-left">
                    <thead>
                        <tr>
                            <th class="order-id">Họ tên</th>
                        <th class="order-date">Tỉnh/thành phố</th>
                        <th class="order-status">Quận/huyện</th>
                        <th class="order-status">Xã/phường/thị trấn</th>
                        <th class="order-status">Số điện thoại</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($address as $key =>$all_address )
                    
    
                        <tr>
                           
                            <td >
                                <p>{{($all_address -> address_name)}}</p>
                                
                            </td>
                            <td >
                                <p>{{($all_address -> name_tinhthanhpho)}}</p>
                            </td>
                            <td >
                                <p>{{($all_address -> name_quanhuyen)}}</p>
                            </td>
                            <td >
                                <p>{{($all_address -> name_xaphuongthitran)}}</p>
                            </td>
                            <td >
                                <p>{{($all_address -> address_phone)}}</p>
                            </td>
                           
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr class="mt-0 mb-1 pb-2" />
    
            </div>
            @if ($login_gg==1)
					
					@else
        <form action="{{URL::to('/change-password/'.$customer_id)}}" method="POST">
            @csrf
            <div class="change-password">
                <h3 class="text-uppercase mb-2">Đổi mật khẩu</h3>
                <?php
                    $message = Session::get('message');
                    $message_succes = Session::get('message-succes');
                    if ($message) {
                        echo "<div class='alert alert-danger'>$message</div>";
                        Session::put('message', null);
                    }
                    if ($message_succes) {
                        echo "<div class='alert alert-success'>$message_succes</div>";
                        Session::put('message_succes', null);
                    }
                    ?>
                <div class="form-group">
                    <label for="acc-password">Mật khẩu cũ</label>
                    <input type="password" class="form-control" id="acc-password"
                        name="old_password" />
                </div>

                <div class="form-group">
                    <label for="acc-password">Mật khẩu mới </label>
                    <input type="password" class="form-control" id="acc-new-password"
                        name="new_password" />
                </div>

            </div>

            <div class="form-footer mt-3 mb-0">
                <button type="submit" class="btn btn-dark mr-0">
                   Lưu thay đổi
                </button>
            </div>
        </form>
        @endif
    </div>
</div>

@endsection