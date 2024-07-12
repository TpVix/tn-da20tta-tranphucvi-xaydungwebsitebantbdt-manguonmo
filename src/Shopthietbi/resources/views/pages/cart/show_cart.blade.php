@extends('layout')
@section('content')
    <main class="main">
        <?php
        $content = $cart_detail;
        ?>

        @if ($content == '[]')
        @else
            <div class="container">
                <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                    <li class="active">
                        <a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/checkout') }}">Thanh toán</a>
                    </li>

                </ul>
                <?php
                $delete_cart = Session::get('delete_cart');
                if ($delete_cart) {
                    echo "<div class='alert alert-success'>$delete_cart</div>";
                    for ($i = 0; $i < 2; $i++) {
                        Session::put('delete_cart', null);
                    }
                }
                ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table-container">

                            <table class="table table-cart">

                                <thead>
                                    <tr>
                                        <th class="thumbnail-col">Hình ảnh</th>
                                        <th class="product-col">Sản phẩm</th>
                                        <th class="price-col">Giá</th>
                                        <th class="qty-col">Số lượng</th>
                                        <th class="text-right">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart_detail as $key => $cart)
                                        @php

                                            $product = DB::table('tbl_product')
                                                ->where('tbl_product.product_id', $cart->product_id)
                                                ->get();
                                            foreach ($product as $slug => $pro_slug) {
                                                Session::put('product_slug', $pro_slug->product_slug);

                                                $product_slug = Session::get('product_slug');
                                            }
                                            $subtotal = $cart->product_price * $cart->product_quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr class="product-row">
                                            <td>
                                                <figure class="product-image-container">


                                                    <a href="{{ URL::to('/san-pham/' . $product_slug) }}"
                                                        class="product-image">
                                                        <img style="width: 100%;height: 100%;"
                                                            src="{{ asset('public/upload/' . $cart->product_image) }}"
                                                            alt="product">
                                                    </a>

                                                    <a href="{{ URL::to('/delete-cart/' . $cart->product_id) }}"
                                                        class="btn-remove icon-cancel" title="Remove Product"></a>
                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    <a
                                                        href="{{ URL::to('/san-pham/' . $product_slug) }}">{{ $cart->product_name }}</a>
                                                </h5>
                                            </td>
                                            <td>{{ number_format($cart->product_price, 0, ',', '.') }}đ</td>
                                            <td>
                                                <form action="{{ URL::to('/update-cart/' . $cart->product_id) }}"
                                                    method="post" style="margin-bottom:0px;">
                                                    @csrf
                                                    <div class="product-single-qty">


                                                        <input class="horizontal-quantity form-control"
                                                            name="cart_qty_{{ $cart->product_id }}"
                                                            value="{{ $cart->product_quantity }}" type="text">

                                                        <div class="float-center">
                                                            <button type="submit" class="btn btn-shop btn-update-cart"
                                                                style="width: 100%;height: 4.6rem;">
                                                                Cập nhật
                                                            </button>
                                                        </div>

                                                    </div><!-- End .product-single-qty -->
                                                </form>
                                            </td>
                                            <td class="text-right"><span
                                                    class="subtotal-price">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="clearfix">
                                            <!-- End .float-left -->

                                            <!-- End .float-right -->
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>


                        </div><!-- End .cart-table-container -->
                    </div><!-- End .col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>TỔNG GIỎ HÀNG</h3>

                            <table class="table table-totals">

                                <tfoot>
                                    <tr>
                                        <td>Tổng tiền</td>
                                        <td>{{ number_format($total, 0, ',', '.') }}đ</td>
                                        @php
                                            Session::put('total', $total);

                                        @endphp
                                    </tr>
                                </tfoot>



                            </table>

                            <div class="checkout-methods">
                                <a href="{{ URL::to('/checkout') }}" class="btn btn-block btn-dark">Thanh toán
                                    <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div><!-- End .cart-summary -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        @endif
    </main><!-- End .main -->
@endsection
