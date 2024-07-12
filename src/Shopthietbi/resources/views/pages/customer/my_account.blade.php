
@extends('pages.layout.layout')
@section('content')
@php
    
    $customer_id = Session::get('customer_id');
	$customer_name = Session::get('customer_name');
@endphp

                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">
                        <p>
                            Xin chào <strong class="text-dark">{{($customer-> customer_name)}}</strong> 
                           
                        </p>

                    

                        <div class="mb-4"></div>

                        <div class="row row-lg">
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{URL::to('/history-order')}}" class="link-to-tab"><i
                                            class="sicon-social-dropbox"></i></a>
                                    <div class="feature-box-content">
                                        <h3>ĐƠN HÀNG</h3>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{URL::to('/dia-chi')}}" class="link-to-tab"><i
                                            class="sicon-location-pin"></i></a>
                                    <div class="feature-box-content">
                                        <h3>ĐỊA CHỈ</h3>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{URL::to('/account-detail/'.$customer_id)}}" class="link-to-tab"><i class="icon-user-2"></i></a>
                                    <div class="feature-box-content p-0">
                                        <h3>THÔNG TIN TÀI KHOẢN</h3>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{URL::to('/show-wishlist')}}"><i class="sicon-heart"></i></a>
                                    <div class="feature-box-content">
                                        <h3>YÊU THÍCH</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="{{URL::to('/logout')}}"><i class="sicon-logout"></i></a>
                                    <div class="feature-box-content">
                                        <h3>ĐĂNG XUẤT</h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .row -->
                    </div>
                </div><!-- End .tab-pane -->

                
            


@endsection