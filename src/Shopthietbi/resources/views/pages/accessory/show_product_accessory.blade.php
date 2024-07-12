
@extends('layout')
@section('content')

<main class="main">
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
        'loop': false
    }">
    @foreach ($banner as $banner)    
    <div class="home-slide2 banner banner-md-vw">
        <img style="background-color: #ccc; min-height:290px; max-height:290px;" width="1476"src="{{URL::to('public/upload/banner/'.$banner -> slider_image)}}" alt="slider image">
        
    </div>
    @endforeach
  
</div>

    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="icon-home"></i></a></li>
                @foreach ($accessory_name as $key => $accessory_name)
                <li class="breadcrumb-item">Danh mục</li>
                
                @if ($accessory_name !=null)
                <li class="breadcrumb-item active" aria-current="page">{{($accessory_name -> accessory_name)}}</li>
                
                @else

                @endif
                
                @endforeach

            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 main-content">
                <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggle">
                            <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                <path
                                    d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                    class="cls-2"></path>
                                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                <path
                                    d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                    class="cls-2"></path>
                            </svg>
                            <span>Filter</span>
                        </a>

                        <form action="{{URL::to('/phu-kien/'.$accessory_name->accessory_slug)}}" method="get">
                            <div class="toolbox-item toolbox-sort">
   
                                
                                @if ( Session::get('low_to_high_accessory')!=null)
                                <div class="select-custom">
                                    <select name="filter_by" class="form-control">
                                        <option value="date">--Lọc--</option>
                                        <option value="low_to_high" selected="selected">Giá: Thấp đến cao</option>
                                        <option value="high_to_low">Giá: Cao đến thấp</option>
                                    </select>
                                </div>
                            @elseif(Session::get('high_to_low_accessory')!=null)
                            <div class="select-custom">
                                <select name="filter_by" class="form-control">
                                    <option value="date">--Lọc--</option>
                                    <option value="low_to_high" >Giá: Thấp đến cao</option>
                                    <option value="high_to_low" selected="selected">Giá: Cao đến thấp</option>
                                </select>
                            </div>
                            @else
                            <div class="select-custom">
                                <select name="filter_by" class="form-control">
                                    
                                    <option value="date" selected="selected">--Lọc--</option>
                                    <option value="low_to_high" >Giá: Thấp đến cao</option>
                                    <option value="high_to_low" >Giá: Cao đến thấp</option>
                                </select>
                            </div> 
                            @endif
                                <!-- End .select-custom -->
                                <button type="submit" style="height: 34px; display: flex; align-items: center;margin-left:1.1rem;text-transform: none;" class="btn btn-outline-dark">Lọc</button>
                                
                            </div>
                        </form>
                        <!-- End .toolbox-item -->
                    </div>
                    <!-- End .toolbox-left -->

                  
                    <!-- End .toolbox-right -->
                </nav>

                <div class="row">
                 
                   
                    @foreach ($product_by_accessory as $key => $product_all_accessory)

                    <div class="col-6 col-sm-4">
                        <div class="product-default">
                            <figure>
                                <a href="{{URL::to('/san-pham/'.$product_all_accessory-> product_slug)}}">
                                    <img src="{{URL::to('public/upload/'.$product_all_accessory -> product_image)}}" style="width: 280px; height: 280px;"alt="product">
                                    <img src="{{URL::to('public/upload/'.$product_all_accessory -> product_image)}}" style="transform: scaleX(-1);width: 280px; height: 280px;" alt="product" />
                                </a>

                                {{-- @if ($product_all_accessory-> product_status == '1')
                                <div class="label-group">
                                    <div class="product-label label-hot"> 
                                        Giảm: {{ round(100 - (($product_all_accessory->product_sale_price / $product_all_accessory->product_price) * 100)) }}%
                                    </div>
                                </div>
                                @else
                                
                                @endif --}}
                            </figure>

                            <div class="product-details">
                               

                                <h3 class="product-title"> <a href="product.html">{{($product_all_accessory-> product_name)}}</a>
                                </h3>

                                <div class="ratings-container">
                                    <ul style="display: flex;">
                                        @php
                                            $count =0;
                                            $mean = 0;
                                            $total_start = 0;
                                            $rating = DB::table('tbl_rating')
                                            ->where('product_id',$product_all_accessory->product_id)
                                            ->orderBy('rating_id','desc') ->get();
                                            
                                            foreach ($rating as $key => $v_rating) {
                                                    $count ++;
                                                    $total_start += ($v_rating->rating_start);
                                                    
                                            }
                                            
                                            if ($count==0) {
                                                $mean=round($total_start);
                                            }else{
                                                $mean=round($total_start/$count);
                                            }
                    
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            if ($i<=$mean){
                                                $color='color:#706f6c;';
                                            }else{
                                                $color='color:#ccc;';
                                            }
                                        @endphp
                                          
                                        
                                        <li 
                                        id=""
                                        data-index=""
                                        data-product_id=""
                                        data-rating=""
                                        class="rating"
                                        style="cursor: pointer;{{$color}} font-size: 25px;"
                                        >
                                          &#9733;
                                        </li>
                                        @endfor
                                    </ul>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                @if ($product_all_accessory->promotion_id != 0)
                                    @php
                                        $active_promotion_new = DB::table('tbl_promotion')
                                            ->where('promotion_status', 'Có')
                                            ->where('promotion_id', $product_all_accessory->promotion_id)
                                            ->get();
                                    @endphp
                                    <div class="price-box">
                                        <del class="old-price">{{ number_format($product_all_accessory->product_price) }}</del><br>
                                        @foreach ($active_promotion_new as $v_active_promotion)
                                            @if ($v_active_promotion->promotion_option == '%')
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format(($product_all_accessory->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                            @else
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($product_all_accessory->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="price-box">
                                        <del class="old-price"></del><br>
                                        <span style="color:red;"
                                            class="product-price">{{ number_format($product_all_accessory->product_price) . ' ' . 'VNĐ' }}</span>
                                    </div>
                                @endif
                                <!-- End .price-box -->
                                <p style="color:#999;font-size: 1.4rem;">Đã bán: {{$product_all_accessory-> quantity_sold}}</p>

                                <div class="product-action">
                                  
                                            <form action="{{URL::to('/add-cart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="cart_product_id" value="{{$product_all_accessory-> product_id}}"
                                                class="cart_product_id_{{$product_all_accessory-> product_id}}">
                                                <input type="hidden" name="cart_product_name" value="{{$product_all_accessory-> product_name}}"
                                                class="cart_product_name_{{$product_all_accessory-> product_id}}">
                                                <input type="hidden" name="cart_product_image" value="{{$product_all_accessory-> product_image}}"
                                                class="cart_product_image_{{$product_all_accessory-> product_id}}">
                                                @if ($product_all_accessory->promotion_id != 0)
                                        @php
                                            $active_promotion_new = DB::table('tbl_promotion')
                                                ->where('promotion_status', 'Có')
                                                ->where('promotion_id', $product_all_accessory->promotion_id)
                                                ->get();
                                        @endphp
                                            @foreach ($active_promotion_new as $v_active_promotion)
                                                @if ($v_active_promotion->promotion_option == '%')
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ ($product_all_accessory->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                        class="cart_product_price_{{ $product_all_accessory->product_id }}">
                                                @else
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $product_all_accessory->product_price - $v_active_promotion->promotion_price }}"
                                                        class="cart_product_price_{{ $product_all_accessory->product_id }}">
                                                @endif
                                            @endforeach
                                        @else
                                            <input type="hidden" name="cart_product_price"
                                                value="{{ $product_all_accessory->product_price }}"
                                                class="cart_product_price_{{ $product_all_accessory->product_id }}">
                                        @endif
                                                <input type="hidden" name="cart_product_qty" value="1" class="" >
                                                <?php 
                                                $customer_id = Session::get('customer_id');
                                                ?>
                                                @if ($customer_id == null)
                                                <a href="{{ URL::to('/login-register') }}"
                                                class="btn-icon btn-add-cart1 product-type-simple">ĐĂNG NHẬP ĐỂ ĐẶT HÀNG</a>
                                                @else
                                                <button type="submit" href="#" class="btn-icon btn-add-cart1 product-type-simple"><i
                                                    class="icon-shopping-cart"></i><span>THÊM VÀO GIỎ HÀNG</span></button>
                                                @endif
                                            </form>
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- End .row -->

                <nav style="justify-content:flex-end;" class="toolbox toolbox-pagination ">                    

                    <ul class="pagination toolbox-item">
                        {{$product_by_accessory->links()}}
                    </ul>
                </nav>
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Danh mục</a>
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach ($category as $key => $category1)
                                            
                                                <li>
                                                    <a href="{{ URL::to('/danh-muc/'.$category1->category_slug) }}"  role="button" aria-expanded="false">
                                                        {{ $category1->category_name }}
                                                        
                                                    </a>
                                                    
                                                </li>
                                            
                                        @endforeach
                                    </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-2">Thương hiệu</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($brand as $key => $brand1)
                                    <li>
                                        <a href="{{URL::to('/thuong-hieu/'.$brand1-> brand_slug)}}"  role="button" aria-expanded="true" aria-controls="widget-all_accessory-1">
                                            {{($brand1 -> brand_name)}}
                                            {{-- <span class="products-count">(3)</span> --}}
                                            {{-- <span class="toggle"></span> --}}
                                        </a>
                                        {{-- <div class="collapse show" id="widget-all_accessory-1">
                                            <ul class="cat-sublist">
                                                <li>Caps<span class="products-count">(1)</span></li>
                                                <li>Watches<span class="products-count">(2)</span></li>
                                            </ul>
                                        </div> --}}
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-3">Lọc theo giá</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body pb-0">
                                <form id="filter_priceForm" autocomplete="off" method="get" action="" onsubmit="setActionURL(event)">
                                    <div class="price-slider-wrapper">
                                        <div id="slider-range"></div>
                                        <!-- End #price-slider -->
                                    </div>
                                    <!-- End .price-slider-wrapper -->
                                    <input type="hidden" name="start_price" id="start_price" >
                                    <input type="hidden" name="end_price" id="end_price" >
                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text" style="width:100%;">
                                            Giá:<br>
                                            <input type="text" id="amount" style="border:0; color:#f61f1f; font-weight:bold;width:100%;">
                                            

                                        </div>
                                        <!-- End .filter-price-text -->

                                        
                                    </div>
                                    <button type="submit"  class="btn btn-outline-dark float-right">Lọc</button>
                                    <!-- End .filter-price-action -->
                                </form>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                   
                  
                </div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->

    <div class="mb-4"></div>
    <!-- margin -->
</main>

@endsection