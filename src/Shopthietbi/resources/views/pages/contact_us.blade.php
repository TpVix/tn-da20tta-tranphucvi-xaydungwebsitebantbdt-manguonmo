@extends('layout')
@section('content')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="demo4.html"><i class="icon-home"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Liên hệ
                </li>
            </ol>
        </div>
    </nav>

    <div id="map">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d982.1117142967026!2d106.34198125586!3d9.935295279006121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a017543aee1d03%3A0xd4993464099847f5!2zQ2jhu6MgVHLDoCBWaW5oLCBQaMaw4budbmcgMywgVHLDoCBWaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1718648450885!5m2!1svi!2s" style="border:0; width:100%;height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    </div>

    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row">
                <div class="col-12">
                    <h2 class="ls-n-25 m-b-1">
                        Thông tin liên hệ
                    </h2>

                    <p>
                        Cửa hàng chúng tôi chuyên cung cấp các thiết bị điện tử chính hãng với đa dạng mẫu mã, giá cả cạnh tranh và dịch vụ chăm sóc khách hàng chu đáo.
                    </p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="sicon-location-pin"></i>
                        <div class="feature-box-content">
                            <h3>Địa chỉ</h3>
                            <h5>Trà Vinh</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Số điện thoại</h3>
                            <h5>(+84) 8634-68532</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-envelope"></i>
                        <div class="feature-box-content">
                            <h3>Địa chỉ E-mail</h3>
                            <h5>vitran641@gmail.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-calendar-alt"></i>
                        <div class="feature-box-content">
                            <h3>Thời gian làm việc/Giờ</h3>
                            <h5>T2 - CN / 8:00AM - 5:00PM</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8"></div>
</main>

@endsection