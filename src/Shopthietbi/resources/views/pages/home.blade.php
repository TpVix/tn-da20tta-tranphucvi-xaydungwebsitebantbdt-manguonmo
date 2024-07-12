@extends('layout')
@section('content')

    <main class="main">
        <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase"
            data-owl-options="{
        'loop': false
    }">
            @foreach ($slider_large as $slider_large)
                <div class="home-slide2 banner banner-md-vw">
                    <img class="slide-bg" style="background-color: #ccc;" width="1903" height="499"
                        src="{{ URL::to('public/upload/banner/' . $slider_large->slider_image) }}" alt="slider image">

                </div>
            @endforeach

            <!-- End .home-slide -->
        </div>
        <!-- End .home-slider -->

        <div class="container">
            <div class="info-boxes-slider owl-carousel owl-theme mb-2"
                data-owl-options="{
            'dots': false,
            'loop': false,
            'responsive': {
                '576': {
                    'items': 2
                },
                '992': {
                    'items': 3
                }
            }
        }">
                <div class="info-box info-box-icon-left">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4>SHIP NHANH CHÓNG</h4>
                        <p class="text-body">Vận chuyển nhanh chóng</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    <i class="icon-money"></i>

                    <div class="info-box-content">
                        <h4>AN TOÀN KHI THANH TOÁN</h4>
                        <p class="text-body">Thanh toán online an toàn</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    <i class="icon-support"></i>

                    <div class="info-box-content">
                        <h4>HỖ TRỢ</h4>
                        <p class="text-body">Email: vitran641@gmail.com</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->
            </div>
            <!-- End .info-boxes-slider -->

            <div class="banners-container mb-2">
                <div class="banners-slider owl-carousel owl-theme"
                    data-owl-options="{
                'dots': false
            }">
                    @foreach ($slider_short as $slider_short)
                        <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate"
                            style="background-color: #ccc;" data-animation-name="fadeInLeftShorter"
                            data-animation-delay="500">
                            <figure class="w-100">
                                <img src="{{ URL::to('public/upload/banner/' . $slider_short->slider_image) }}"
                                    alt="banner" width="380" height="175" />
                            </figure>

                        </div>
                        <!-- End .banner -->
                    @endforeach

                    <!-- End .banner -->
                </div>
            </div>
        </div>
        <!-- End .container -->

        <section class="featured-products-section">
            <div class="container">
                <h2 class="section-title heading-border ls-20 border-0">Sản phẩm bán chạy</h2>

                <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                'dots': false,
                'nav': true
            }">
                @foreach ($selling_products as $v_selling_products)
                    
                
                    <div class="product-default " data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ URL::to('/san-pham/' . $v_selling_products->product_slug) }}">
                                <img src="{{ URL::to('public/upload/' . $v_selling_products->product_image) }}" width="280" height="280"
                                style="height: 280px;width:280px;"  alt="product">
                                <img src="{{ URL::to('public/upload/' . $v_selling_products->product_image) }}" width="280" height="280"
                                style="transform: scaleX(-1);height: 280px;width:280px;" alt="product">
                            </a>
                            {{-- <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div> --}}
                        </figure>
                        <div class="product-details">
                            
                            <h3 class="product-title">
                                <a href="{{ URL::to('/san-pham/' . $v_selling_products->product_slug) }}">{{$v_selling_products->product_name}}</a>
                            </h3>
                            <div>
                                <ul style="display: flex;">
                                    @php
                                        $count_selling_product = 0;
                                        $mean_selling_product = 0;
                                        $total_start_selling_product = 0;

                                        $rating = DB::table('tbl_rating')
                                          
                                            ->where('product_id', $v_selling_products->product_id)
                                            ->orderBy('rating_id', 'desc')
                                            ->get();
                                        foreach ($rating as $key => $v_rating) {
                                            $count_selling_product++;
                                            $total_start_selling_product += $v_rating->rating_start;
                                        }

                                        if ($count_selling_product == 0) {
                                            $mean_selling_product = round($total_start_selling_product);
                                        } else {
                                            $mean_selling_product = round(
                                                $total_start_selling_product / $count_selling_product,
                                            );
                                        }

                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            if ($i <= $mean_selling_product) {
                                                $color = 'color:#706f6c;';
                                            } else {
                                                $color = 'color:#ccc;';
                                            }
                                        @endphp


                                        <li id="" data-index="" data-product_id="" data-rating=""
                                            class="rating"
                                            style="cursor: pointer;{{ $color }} font-size: 25px;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            @if ($v_selling_products->promotion_id != 0)
                                    @php
                                        $active_promotion_selling = DB::table('tbl_promotion')
                                           
                                            ->where('promotion_id', $v_selling_products->promotion_id)
                                            ->get();
                                    @endphp
                                    <div class="price-box">
                                       
                                    @foreach ($active_promotion_selling as $v_active_promotion)
                                        
                                        @if ($v_active_promotion->promotion_status == 'Có')
                                            @if ($v_active_promotion->promotion_option == '%')
                                            <del class="old-price">{{ number_format($v_selling_products->product_price) }}</del><br>
                                            <span style="color:red;"
                                                class="product-price">{{ number_format(($v_selling_products->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                            @else
                                            <del class="old-price">{{ number_format($v_selling_products->product_price) }}</del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($v_selling_products->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                            @endif
                                        @else
                                        
                                            <del class="old-price"></del><br>
                                            <span style="color:red;"
                                                class="product-price">{{ number_format($v_selling_products->product_price) . ' ' . 'VNĐ' }}</span>
                                        
                                        @endif
                                    @endforeach  
                                    </div>
                                @else
                                    <div class="price-box">
                                        <del class="old-price"></del><br>
                                        <span style="color:red;"
                                            class="product-price">{{ number_format($v_selling_products->product_price) . ' ' . 'VNĐ' }}</span>
                                    </div>
                                @endif
                                <p style="color:#999;font-size: 1.4rem;">Đã bán: {{ $v_selling_products->quantity_sold }}</p>
                            <!-- End .price-box -->
                            <div class="product-action">
                                
                                <form action="{{ URL::to('/add-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="cart_product_id"
                                        value="{{ $v_selling_products->product_id }}"
                                        class="cart_product_id_{{ $v_selling_products->product_id }}">
                                    <input type="hidden" name="cart_product_name"
                                        value="{{ $v_selling_products->product_name }}"
                                        class="cart_product_name_{{ $v_selling_products->product_id }}">
                                    <input type="hidden" name="cart_product_image"
                                        value="{{ $v_selling_products->product_image }}"
                                        class="cart_product_image_{{ $v_selling_products->product_id }}">
                                    @if ($v_selling_products->promotion_id != 0)
                                    @php
                                        $active_promotion_selling = DB::table('tbl_promotion')
                                            ->where('promotion_id', $v_selling_products->promotion_id)
                                            ->get();
                                    @endphp
                                        @foreach ($active_promotion_selling as $v_active_promotion)
                                            @if ($v_active_promotion->promotion_status == 'Có')
                                                @if ($v_active_promotion->promotion_option == '%')
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ ($v_selling_products->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                        class="cart_product_price_{{ $v_selling_products->product_id }}">
                                                @else
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $v_selling_products->product_price - $v_active_promotion->promotion_price }}"
                                                        class="cart_product_price_{{ $v_selling_products->product_id }}">
                                                @endif
                                            @else
                                                <input type="hidden" name="cart_product_price"
                                                value="{{ $v_selling_products->product_price }}"
                                                class="cart_product_price_{{ $v_selling_products->product_id }}">
                                            @endif
                                        @endforeach
                                    @else
                                        <input type="hidden" name="cart_product_price"
                                            value="{{ $v_selling_products->product_price }}"
                                            class="cart_product_price_{{ $v_selling_products->product_id }}">
                                    @endif

                                    <input type="hidden" name="cart_product_qty" value="1" class="">
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    ?>
                                    @if ($customer_id == null)
                                        <a href="{{ URL::to('/login-register') }}"
                                            class="btn-icon btn-add-cart1 product-type-simple">ĐĂNG NHẬP ĐỂ ĐẶT
                                            HÀNG</a>
                                    @else
                                        <button type="submit" href="#"
                                            class="btn-icon btn-add-cart1 product-type-simple"><i
                                                class="icon-shopping-cart"></i><span>THÊM VÀO GIỎ HÀNG</span></button>
                                    @endif
                                </form>
                                
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
                </div>
                <!-- End .featured-proucts -->
            </div>
        </section>
        
        <section class="new-products-section">
            
                
                <div class="container">
                    @if ($new_product!= '[]')
                    <h2 class="section-title heading-border ls-20 border-0">Sản phẩm mới</h2>
                    @else
                    
                    @endif
                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                        data-owl-options="{
                    'dots': false,
                    'nav': true,
                    'responsive': {
                        '992': {
                            'items': 4
                        },
                        '1200': {
                            'items': 5
                        }
                    }
                }">
                        @foreach ($new_product as $key => $new_product)
                            <div class="product-default" data-animation-name="fadeInRightShorter">
                                <figure>
                                    <a href="{{ URL::to('/san-pham/' . $new_product->product_slug) }}">
                                        <img src="{{ URL::to('public/upload/' . $new_product->product_image) }}"style="height: 220px;width:220px;"
                                            alt="product">
                                        <img src="{{ URL::to('public/upload/' . $new_product->product_image) }}"
                                            style="transform: scaleX(-1);height: 220px;width:220px;" alt="product">
                                    </a>
                                    {{-- @if ($new_product->product_status == '1')
                            <div class="label-group">
                                <div class="product-label label-hot"> 
                                    Giảm: {{ round(100 - (($new_product->product_sale_price / $new_product->product_price) * 100)) }}%
                                </div>
                            </div>
                            @else
                            
                            @endif --}}
    
                                </figure>
                                <div class="product-details">
                                   
                                    <h3 class="product-title">
                                        <a href="{{ URL::to('/san-pham/' . $new_product->product_slug) }}">{{ $new_product->product_name }}</a>
                                    </h3>
                                    <div>
                                        <ul style="display: flex;">
                                            @php
                                                $count_new_product = 0;
                                                $mean_new_product = 0;
                                                $total_start_new_product = 0;
    
                                                $rating = DB::table('tbl_rating')
                                                   
                                                    ->where('product_id', $new_product->product_id)
                                                    ->orderBy('rating_id', 'desc')
                                                    ->get();
                                                foreach ($rating as $key => $v_rating) {
                                                    $count_new_product++;
                                                    $total_start_new_product += $v_rating->rating_start;
                                                }
    
                                                if ($count_new_product == 0) {
                                                    $mean_new_product = round($total_start_new_product);
                                                } else {
                                                    $mean_new_product = round(
                                                        $total_start_new_product / $count_new_product,
                                                    );
                                                }
    
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php
                                                    if ($i <= $mean_new_product) {
                                                        $color = 'color:#706f6c;';
                                                    } else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                @endphp
    
    
                                                <li id="" data-index="" data-product_id="" data-rating=""
                                                    class="rating"
                                                    style="cursor: pointer;{{ $color }} font-size: 25px;">
                                                    &#9733;
                                                </li>
                                            @endfor
                                        </ul>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    @if ($new_product->promotion_id != 0)
                                        @php
                                            $active_promotion_new = DB::table('tbl_promotion')
                                                
                                                ->where('promotion_id', $new_product->promotion_id)
                                                ->get();
                                        @endphp
                                        <div class="price-box">
                                            
                                            @foreach ($active_promotion_new as $v_active_promotion)
                                            
                                                @if ($v_active_promotion->promotion_status == 'Có')
                                                    @if ($v_active_promotion->promotion_option == '%')
                                                    <del class="old-price">{{ number_format($new_product->product_price) }}</del><br>
                                                    <span style="color:red;"
                                                        class="product-price">{{ number_format(($new_product->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                                    @else
                                                    <del class="old-price">{{ number_format($new_product->product_price) }}</del><br>
                                                        <span style="color:red;"
                                                            class="product-price">{{ number_format($new_product->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                                    @endif
                                                @else
                                                        <del class="old-price"></del><br>
                                                        <span style="color:red;"
                                                            class="product-price">{{ number_format($new_product->product_price) . ' ' . 'VNĐ' }}</span>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="price-box">
                                            <del class="old-price"></del><br>
                                            <span style="color:red;"
                                                class="product-price">{{ number_format($new_product->product_price) . ' ' . 'VNĐ' }}</span>
                                        </div>
                                    @endif
                                    <p style="color:#999;font-size: 1.4rem;">Đã bán: {{ $new_product->quantity_sold }}</p>
    
                                    <!-- End .price-box -->
                                    <div class="product-action">
    
    
                                        <form action="{{ URL::to('/add-cart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_product_id"
                                                value="{{ $new_product->product_id }}"
                                                class="cart_product_id_{{ $new_product->product_id }}">
                                            <input type="hidden" name="cart_product_name"
                                                value="{{ $new_product->product_name }}"
                                                class="cart_product_name_{{ $new_product->product_id }}">
                                            <input type="hidden" name="cart_product_image"
                                                value="{{ $new_product->product_image }}"
                                                class="cart_product_image_{{ $new_product->product_id }}">
                                            @if ($new_product->promotion_id != 0)
                                            @php
                                                $active_promotion_new = DB::table('tbl_promotion')
                                                    ->where('promotion_id', $new_product->promotion_id)
                                                    ->get();
                                            @endphp
                                                @foreach ($active_promotion_new as $v_active_promotion)
                                                    @if ($v_active_promotion->promotion_status == 'Có')
                                                        @if ($v_active_promotion->promotion_option == '%')
                                                            <input type="hidden" name="cart_product_price"
                                                                value="{{ ($new_product->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                                class="cart_product_price_{{ $new_product->product_id }}">
                                                        @else
                                                            <input type="hidden" name="cart_product_price"
                                                                value="{{ $new_product->product_price - $v_active_promotion->promotion_price }}"
                                                                class="cart_product_price_{{ $new_product->product_id }}">
                                                        @endif
                                                    @else
                                                        <input type="hidden" name="cart_product_price"
                                                        value="{{ $new_product->product_price }}"
                                                        class="cart_product_price_{{ $new_product->product_id }}">
                                                    @endif
                                                @endforeach
                                            @else
                                                <input type="hidden" name="cart_product_price"
                                                    value="{{ $new_product->product_price }}"
                                                    class="cart_product_price_{{ $new_product->product_id }}">
                                            @endif
    
                                            <input type="hidden" name="cart_product_qty" value="1" class="">
                                            <?php
                                            $customer_id = Session::get('customer_id');
                                            ?>
                                            @if ($customer_id == null)
                                                <a href="{{ URL::to('/login-register') }}"
                                                    class="btn-icon btn-add-cart1 product-type-simple">ĐĂNG NHẬP ĐỂ ĐẶT
                                                    HÀNG</a>
                                            @else
                                                <button type="submit" href="#"
                                                    class="btn-icon btn-add-cart1 product-type-simple"><i
                                                        class="icon-shopping-cart"></i><span>THÊM VÀO GIỎ HÀNG</span></button>
                                            @endif
                                        </form>
    
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        @endforeach
                        
                    </div>
                
                @foreach ($active_promotion as $v_active_promotion)
                    @php
                        $product_promotion = DB::table('tbl_product')
                            ->where('promotion_id', $v_active_promotion->promotion_id)
                            ->get();
                    @endphp
                    @if ($product_promotion != '[]')
                        <h2 class="section-title heading-border ls-20 border-0">{{ $v_active_promotion->promotion_name }}
                        </h2>
                        <p class=" heading-border border-0"><b> {{ $v_active_promotion->promotion_des }}</b>
                        </p>
                        <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                            data-owl-options="{
                            'dots': false,
                            'nav': true,
                            'responsive': {
                                '992': {
                                    'items': 4
                                },
                                '1200': {
                                    'items': 5
                                }
                            }
                        }">

                            @foreach ($product_promotion as $key => $v_product_promotion)
                                <div class="product-default" data-animation-name="fadeInRightShorter">
                                    <figure>
                                        <a href="{{ URL::to('/san-pham/' . $v_product_promotion->product_slug) }}">
                                            <img src="{{ URL::to('public/upload/' . $v_product_promotion->product_image) }}"style="height: 220px;width:220px;"
                                                alt="product">
                                            <img src="{{ URL::to('public/upload/' . $v_product_promotion->product_image) }}"
                                                style="transform: scaleX(-1);height: 220px;width:220px;" width="280"
                                                height="280" alt="product">
                                        </a>
                                        {{-- @if ($v_product_promotion->product_status == '1')
                                        <div class="label-group">
                                            <div class="product-label label-hot"> 
                                                Giảm: {{ round(100 - (($v_product_promotion->product_sale_price / $v_product_promotion->product_price) * 100)) }}%
                                            </div>
                                        </div>
                                        @else
                                        
                                        @endif --}}

                                    </figure>
                                    <div class="product-details">
                                        
                                        <h3 class="product-title">
                                            <a href="{{ URL::to('/san-pham/' . $v_product_promotion->product_slug) }}">{{ $v_product_promotion->product_name }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <ul style="display: flex;">
                                                @php
                                                    $count_product_promotion = 0;
                                                    $mean_product_promotion = 0;
                                                    $total_start_product_promotion = 0;
                                                    $rating = DB::table('tbl_rating')
                                                        
                                                        ->where('product_id', $v_product_promotion->product_id)
                                                        ->orderBy('rating_id', 'desc')
                                                        ->get();

                                                    foreach ($rating as $key => $v_rating) {
                                                        $count_product_promotion++;
                                                        $total_start_product_promotion += $v_rating->rating_start;
                                                    }

                                                    if ($count_product_promotion == 0) {
                                                        $mean_product_promotion = round($total_start_product_promotion);
                                                    } else {
                                                        $mean_product_promotion = round(
                                                            $total_start_product_promotion / $count_product_promotion,
                                                        );
                                                    }

                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php
                                                        if ($i <= $mean_product_promotion) {
                                                            $color = 'color:#706f6c;';
                                                        } else {
                                                            $color = 'color:#ccc;';
                                                        }
                                                    @endphp


                                                    <li id="" data-index="" data-product_id="" data-rating=""
                                                        class="rating"
                                                        style="cursor: pointer;{{ $color }} font-size: 25px;">
                                                        &#9733;
                                                    </li>
                                                @endfor
                                            </ul>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->


                                        <div class="price-box">
                                            <del
                                                class="old-price">{{ number_format($v_product_promotion->product_price) }}</del><br>
                                            @if ($v_active_promotion->promotion_option == '%')
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format(($v_product_promotion->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                            @else
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($v_product_promotion->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                            @endif
                                        </div>

                                        <p style="color:#999;font-size: 1.4rem;">Đã bán:
                                            {{ $v_product_promotion->quantity_sold }}
                                        </p>

                                        <!-- End .price-box -->
                                        <div class="product-action">


                                            <form action="{{ URL::to('/add-cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="cart_product_id"
                                                    value="{{ $v_product_promotion->product_id }}"
                                                    class="cart_product_id_{{ $v_product_promotion->product_id }}">
                                                <input type="hidden" name="cart_product_name"
                                                    value="{{ $v_product_promotion->product_name }}"
                                                    class="cart_product_name_{{ $v_product_promotion->product_id }}">
                                                <input type="hidden" name="cart_product_image"
                                                    value="{{ $v_product_promotion->product_image }}"
                                                    class="cart_product_image_{{ $v_product_promotion->product_id }}">
                                                    @if ($v_product_promotion->promotion_id != 0)
                                                    @php
                                                         $active_promotion = DB::table('tbl_promotion')
                                                        ->where('promotion_status', 'Có')
                                                        ->where('promotion_id', $v_product_promotion->promotion_id)
                                                        ->get();
                                                    @endphp
                                                        @foreach ($active_promotion as $v_active_promotion)
                                                            @if ($v_active_promotion->promotion_option == '%')
                                                                <input type="hidden" name="cart_product_price"
                                                                    value="{{ ($v_product_promotion->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                                    class="cart_product_price_{{ $v_product_promotion->product_id }}">
                                                            @else
                                                                <input type="hidden" name="cart_product_price"
                                                                    value="{{ $v_product_promotion->product_price - $v_active_promotion->promotion_price }}"
                                                                    class="cart_product_price_{{ $v_product_promotion->product_id }}">
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <input type="hidden" name="cart_product_price"
                                                            value="{{ $v_product_promotion->product_price }}"
                                                            class="cart_product_price_{{ $v_product_promotion->product_id }}">
                                                    @endif
                                                <input type="hidden" name="cart_product_qty" value="1"
                                                    class="">
                                                <?php
                                                $customer_id = Session::get('customer_id');
                                                ?>
                                                @if ($customer_id == null)
                                                    <a href="{{ URL::to('/login-register') }}"
                                                        class="btn-icon btn-add-cart1 product-type-simple">ĐĂNG NHẬP ĐỂ ĐẶT
                                                        HÀNG</a>
                                                @else
                                                    <button type="submit" href="#"
                                                        class="btn-icon btn-add-cart1 product-type-simple"><i
                                                            class="icon-shopping-cart"></i><span>THÊM VÀO GIỎ
                                                            HÀNG</span></button>
                                                @endif
                                            </form>

                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            @endforeach
                        </div>
                    @else
                    @endif
                @endforeach

                <!-- End .featured-proucts -->
                @if (isset($RCM_product) && !$RCM_product->isEmpty())
                    <h2 class="section-title heading-border ls-20 border-0">Sản phẩm gợi ý</h2>
                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                        data-owl-options="{
                            'dots': false,
                            'nav': true,
                            'responsive': {
                                '992': {
                                    'items': 4
                                },
                                '1200': {
                                    'items': 5
                                }
                            }
                        }">
                        @foreach ($RCM_product as $key => $v_RCM_product)
                            <div class="product-default" data-animation-name="fadeInRightShorter">
                                <figure>
                                    <a href="{{ URL::to('/san-pham/' . $v_RCM_product->product_slug) }}">
                                        <img src="{{ URL::to('public/upload/' . $v_RCM_product->product_image) }}"style="height: 220px;width:220px;"
                                            alt="product">
                                        <img src="{{ URL::to('public/upload/' . $v_RCM_product->product_image) }}"
                                            style="transform: scaleX(-1);height: 220px;width:220px;" width="280"
                                            height="280" alt="product">
                                    </a>
                                    {{-- @if ($v_RCM_product->product_status == '1')
                                        <div class="label-group">
                                            <div class="product-label label-hot"> 
                                                Giảm: {{ round(100 - (($v_RCM_product->product_sale_price / $v_RCM_product->product_price) * 100)) }}%
                                            </div>
                                        </div>
                                        @else
                                        
                                        @endif --}}

                                </figure>
                                <div class="product-details">
                                    
                                    <h3 class="product-title">
                                        <a href="{{ URL::to('/san-pham/' . $v_RCM_product->product_slug) }}">{{ $v_RCM_product->product_name }}</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <ul style="display: flex;">
                                            @php
                                                $count = 0;
                                                $mean = 0;
                                                $total_start = 0;
                                                $rating = DB::table('tbl_rating')
                                                    
                                                    ->where('product_id', $v_RCM_product->product_id)
                                                    ->orderBy('rating_id', 'desc')
                                                    ->get();

                                                foreach ($rating as $key => $v_rating) {
                                                    $count++;
                                                    $total_start += $v_rating->rating_start;
                                                }

                                                if ($count == 0) {
                                                    $mean = round($total_start);
                                                } else {
                                                    $mean = round($total_start / $count);
                                                }

                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php
                                                    if ($i <= $mean) {
                                                        $color = 'color:#706f6c;';
                                                    } else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                @endphp


                                                <li id="" data-index="" data-product_id="" data-rating=""
                                                    class="rating"
                                                    style="cursor: pointer;{{ $color }} font-size: 25px;">
                                                    &#9733;
                                                </li>
                                            @endfor
                                        </ul>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    @if ($v_RCM_product->promotion_id != 0)
                                    @php
                                        $active_promotion_rcm = DB::table('tbl_promotion')
                                           
                                            ->where('promotion_id', $v_RCM_product->promotion_id)
                                            ->get();
                                    @endphp
                                    <div class="price-box">
                                        @foreach ($active_promotion_rcm as $v_active_promotion)
                                        
                                            @if ($v_active_promotion->promotion_status == 'Có')
                                                @if ($v_active_promotion->promotion_option == '%')
                                                <del class="old-price">{{ number_format($v_RCM_product->product_price) }}</del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format(($v_RCM_product->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                                @else
                                                <del class="old-price">{{ number_format($v_RCM_product->product_price) }}</del><br>
                                                    <span style="color:red;"
                                                        class="product-price">{{ number_format($v_RCM_product->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                                @endif
                                            @else
                                            
                                                
                                                    <del class="old-price"></del><br>
                                                    <span style="color:red;"
                                                        class="product-price">{{ number_format($v_RCM_product->product_price) . ' ' . 'VNĐ' }}</span>
                                               
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="price-box">
                                        <del class="old-price"></del><br>
                                        <span style="color:red;"
                                            class="product-price">{{ number_format($v_RCM_product->product_price) . ' ' . 'VNĐ' }}</span>
                                    </div>
                                @endif
                                    <p style="color:#999;font-size: 1.4rem;">Đã bán: {{ $v_RCM_product->quantity_sold }}
                                    </p>

                                    <!-- End .price-box -->
                                    <div class="product-action">


                                        <form action="{{ URL::to('/add-cart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_product_id"
                                                value="{{ $v_RCM_product->product_id }}"
                                                class="cart_product_id_{{ $v_RCM_product->product_id }}">
                                            <input type="hidden" name="cart_product_name"
                                                value="{{ $v_RCM_product->product_name }}"
                                                class="cart_product_name_{{ $v_RCM_product->product_id }}">
                                            <input type="hidden" name="cart_product_image"
                                                value="{{ $v_RCM_product->product_image }}"
                                                class="cart_product_image_{{ $v_RCM_product->product_id }}">
                                                @if ($v_RCM_product->promotion_id != 0)
                                                @php
                                                    $active_promotion_rcm = DB::table('tbl_promotion')
                                                        ->where('promotion_id', $v_RCM_product->promotion_id)
                                                        ->get();
                                                @endphp
                                                    @foreach ($active_promotion_rcm as $v_active_promotion)
                                                        @if ($v_active_promotion->promotion_status == 'Có')
                                                            @if ($v_active_promotion->promotion_option == '%')
                                                                <input type="hidden" name="cart_product_price"
                                                                    value="{{ ($v_RCM_product->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                                    class="cart_product_price_{{ $v_RCM_product->product_id }}">
                                                            @else
                                                                <input type="hidden" name="cart_product_price"
                                                                    value="{{ $v_RCM_product->product_price - $v_active_promotion->promotion_price }}"
                                                                    class="cart_product_price_{{ $v_RCM_product->product_id }}">
                                                            @endif
                                                        @else
                                                            <input type="hidden" name="cart_product_price"
                                                            value="{{ $v_RCM_product->product_price }}"
                                                            class="cart_product_price_{{ $v_RCM_product->product_id }}">
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $v_RCM_product->product_price }}"
                                                        class="cart_product_price_{{ $v_RCM_product->product_id }}">
                                                @endif
                                            <input type="hidden" name="cart_product_qty" value="1" class="">
                                            <?php
                                            $customer_id = Session::get('customer_id');
                                            ?>
                                            @if ($customer_id == null)
                                                <a href="{{ URL::to('/login-register') }}"
                                                    class="btn-icon btn-add-cart1 product-type-simple">ĐĂNG NHẬP ĐỂ ĐẶT
                                                    HÀNG</a>
                                            @else
                                                <button type="submit" href="#"
                                                    class="btn-icon btn-add-cart1 product-type-simple"><i
                                                        class="icon-shopping-cart"></i><span>THÊM VÀO GIỎ
                                                        HÀNG</span></button>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        @endforeach
                    </div>
                @else
                @endif




                
            </div>
        </section>


    </main>

@endsection
