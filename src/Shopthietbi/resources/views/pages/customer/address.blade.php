
@extends('pages.layout.layout')
@section('content')


<div id="address" role="tabpanel">
    <h3 class="account-sub-title d-none d-md-block mb-1"><i
            class="sicon-location-pin align-middle mr-3"></i>Địa chỉ</h3>
    <div class="addresses-content">
        <div class="order-table-container text-center">
            <table class="table table-order text-left">
                <thead>
                    <tr>
                        <th class="order-id">Họ tên</th>
                        <th class="order-date">Tỉnh/thành phố</th>
                        <th class="order-status">Quận/huyện</th>
                        <th class="order-status">Xã/phường/thị trấn</th>
                        <th class="order-status">Số điện thoại</th>
                        <th class="order-action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_address as $key =>$all_address )
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo "<div class='alert alert-success'>$message</div>";
                        Session::put('message', null);
                    }
                    ?>

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
                       
                        <td style="display: flex;">
                            <a class="btn btn-primary" href="{{URL::to('/choose-address/' . $all_address -> address_id)}}">Chọn</a>
                            <a class="btn btn-success" href="{{URL::to('/edit-address/'.$all_address -> address_id)}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a class="btn btn-danger" href="{{URL::to('/delete-address/'.$all_address -> address_id)}}"><i class="fa fa-times"></i></a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="mt-0 mb-3 pb-2" />

            <a href="{{URL::to('/add-address')}}" class="btn btn-dark">Thêm địa chỉ</a>
        </div>
    </div>
</div><!-- End .tab-pane -->


@endsection