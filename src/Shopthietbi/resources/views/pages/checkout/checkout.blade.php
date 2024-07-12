@extends('layout')
@section('content')
    <main class="main main-test">

        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a>
                </li>
                <li class="active">
                    <a href="{{ URL::to('/checkout') }}">Thanh toán</a>
                </li>
                
            </ul>

            <form id="form_normal">
                @csrf
                <div class="row">

                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Chi tiết thanh toán</h2>



                                @foreach ($address as $key => $address1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên <span class="required">*</span></label>
                                                <input readonly name="shipping_name" value="{{ $address1->address_name }}"
                                                    type="text" class="form-control shipping_name" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tỉnh/thành phố <span class="required">*</span></label>
                                                <input readonly name="city" value="{{ $address1->name_tinhthanhpho }}"
                                                    type="text" class="form-control city" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quận/huyện <span class="required">*</span></label>
                                                <input readonly name="district" value="{{ $address1->name_quanhuyen }}"
                                                    type="text" class="form-control district" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Xã/phường/thị trấn <span class="required">*</span></label>
                                                <input readonly name="ward"
                                                    value="{{ $address1->name_xaphuongthitran }}" type="text"
                                                    class="form-control ward" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại <span class="required">*</span></label>
                                                <input readonly name="shipping_phone"
                                                    value="{{ $address1->address_phone }}" type="text"
                                                    class="form-control shipping_phone" required />
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Địa chỉ <span class="required">*</span></label>
                                                <input name="shipping_address" type="text"
                                                    class="form-control shipping_address" placeholder="Số nhà, tên đường"
                                                     />
                                            </div>
                                        </div>
                                    </div>






                                    <div class="form-group">
                                        <label class="order-comments">Ghi chú</label>
                                        <textarea class="form-control shipping_note" name="shipping_note" placeholder="Ghi chú cụ thể"></textarea>
                                    </div>
                                @endforeach


                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>Đơn đặt hàng</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart_detail as $key => $cart1)
                                        @php
                                            $subtotal = $cart1->product_price * $cart1->product_quantity;
                                            $total = Session::get('total');
                                        @endphp

                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $cart1->product_name }} ×
                                                    <span class="product-qty">{{ $cart1->product_quantity }}</span>
                                                </h3>
                                            </td>

                                            <td class="price-col">
                                                <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Tiền ship</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>{{ number_format($shipping_fee, 0, ',', '.') }}đ</span>
                                        </td>
                                    </tr>

                                    <tr class="order-total">
                                        <td>
                                            <h4>Tổng tiền</h4>
                                        </td>
                                        <td>
                                            <b
                                                class="total-price"><span>{{ number_format($total + $shipping_fee, 0, ',', '.') }}đ</span></b>
                                            @php

                                                Session::put('shipping_fee', $shipping_fee);
                                            @endphp
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <tr class="order-shipping">
                                <td class="text-left" colspan="2">
                                    <h4 class="m-b-sm">Phương thức thanh toán</h4>

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input value="Thanh toán khi nhận hàng" type="radio"
                                                class="custom-control-input payment_option" id="normal_check" name="payment_option" checked />
                                            <label class="custom-control-label">Thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group form-group-custom-control">
                                <div class="custom-control custom-radio d-flex">
                                    <input value="Thanh toán Momo" type="radio" class="custom-control-input payment_option" name="payment_option" />
                                    <label class="custom-control-label">Thanh toán Momo</label>
                                </div>
                            </div> --}}

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input value="Thanh toán VNPay" type="radio"
                                                class="custom-control-input payment_option" name="payment_option" />
                                            <label class="custom-control-label">Thanh toán VNPay</label>
                                        </div>
                                    </div>
                                    <!-- End .form-group -->
                                </td>

                            </tr>

                            <input type="hidden" class="order_code" value="{{ $order_code }}">
                            <input type="button" id="btn-checkout" name="" class="btn btn-dark btn-place-order"
                                value="Thanh toán">


                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->

                </div>
            </form>
            <form action="{{ url('/vnpay-payment') }}" id="form_vnpay" hidden method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Chi tiết thanh toán</h2>
                                @foreach ($address as $key => $address2)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên <span class="required">*</span></label>
                                                <input readonly name="shipping_name" value="{{ $address2->address_name }}"
                                                    type="text" class="form-control shipping_name" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tỉnh/thành phố <span class="required">*</span></label>
                                                <input readonly name="city" value="{{ $address2->name_tinhthanhpho }}"
                                                    type="text" class="form-control city" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quận/huyện <span class="required">*</span></label>
                                                <input readonly name="district" value="{{ $address2->name_quanhuyen }}"
                                                    type="text" class="form-control district" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Xã/phường/thị trấn <span class="required">*</span></label>
                                                <input readonly name="ward"
                                                    value="{{ $address2->name_xaphuongthitran }}" type="text"
                                                    class="form-control ward" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại <span class="required">*</span></label>
                                                <input readonly name="shipping_phone"
                                                    value="{{ $address2->address_phone }}" type="text"
                                                    class="form-control shipping_phone" required />
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Địa chỉ <span class="required">*</span></label>
                                                <input name="shipping_address" type="text"
                                                    class="form-control shipping_address" placeholder="Số nhà, tên đường"
                                                     />
                                            </div>
                                        </div>
                                    </div>






                                    <div class="form-group">
                                        <label class="order-comments">Ghi chú</label>
                                        <textarea class="form-control shipping_note" name="shipping_note" placeholder="Ghi chú cụ thể"></textarea>
                                    </div>
                                @endforeach


                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>Đơn đặt hàng</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total2 = 0;
                                    @endphp
                                    @foreach ($cart_detail as $key => $cart2)
                                        @php
                                            $subtotal2 = $cart2->product_price * $cart2->product_quantity;
                                            $total2 = Session::get('total');
                                        @endphp

                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $cart2->product_name }} ×
                                                    <span class="product-qty">{{ $cart2->product_quantity }}</span>
                                                </h3>
                                            </td>

                                            <td class="price-col">
                                                <span>{{ number_format($subtotal2, 0, ',', '.') }}đ</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Tiền ship</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>{{ number_format($shipping_fee, 0, ',', '.') }}đ</span>
                                        </td>
                                    </tr>

                                    <tr class="order-total">
                                        <td>
                                            <h4>Tổng tiền</h4>
                                        </td>
                                        <td>
                                            <b
                                                class="total-price"><span>{{ number_format($total2 + $shipping_fee, 0, ',', '.') }}đ</span></b>
                                            @php

                                                Session::put('shipping_fee', $shipping_fee);
                                            @endphp
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <tr class="order-shipping">
                                <td class="text-left" colspan="2">
                                    <h4 class="m-b-sm">Phương thức thanh toán</h4>

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input value="Thanh toán khi nhận hàng" type="radio"
                                                class="custom-control-input payment_option" name="payment_option"  />
                                            <label class="custom-control-label">Thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group form-group-custom-control">
                                <div class="custom-control custom-radio d-flex">
                                    <input value="Thanh toán Momo" type="radio" class="custom-control-input payment_option" name="payment_option" />
                                    <label class="custom-control-label">Thanh toán Momo</label>
                                </div>
                            </div> --}}

                                    <div class="form-group form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input value="Thanh toán VNPay" id="vnpay_check" type="radio"
                                                class="custom-control-input payment_option" name="payment_option"  />
                                            <label class="custom-control-label">Thanh toán VNPay</label>
                                        </div>
                                    </div>
                                    <!-- End .form-group -->
                                </td>

                            </tr>

                            <input type="hidden" name="order_code" class="order_code" value="{{ $order_code }}">
                            <input type="hidden" name="total" class="order_code" value="{{$total2 + $shipping_fee}}">
                            <input type="submit" id="btn-vnpay" name="redirect" class="btn btn-dark btn-place-order"
                    value="Thanh toán VN pay">


                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->

                </div>
                
            </form> <!-- End .row -->
        </div>
        <!-- End .container -->

    </main>
@endsection
