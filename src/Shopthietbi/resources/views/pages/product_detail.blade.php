@extends('layout')
@section('content')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a>Sản phẩm</a></li>
                    @foreach ($product_detail as $key => $detail_name)
                        <li class="breadcrumb-item"><a>{{ $detail_name->product_name }}</a></li>
                    @endforeach
                </ol>
            </nav>

            <div class="product-single-container product-single-default">

                @foreach ($product_detail as $key => $detail)
                    {{-- <form action="{{url('/save-cart')}}" method="post">
                {{ csrf_field() }} --}}

                    <div class="row">
                        <div class="col-lg-5 col-md-6 product-single-gallery">
                            <div class="product-slider-container">
                                <div class="label-group">
                                    {{-- @if ($detail->product_status == '1')
                                        <div class="label-group">
                                            <div class="product-label label-hot">
                                                Giảm:
                                                {{ round(100 - ($detail->product_sale_price / $detail->product_price) * 100) }}%
                                            </div>
                                        </div>
                                    @else
                                    @endif --}}
                                </div>

                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image"
                                            src="{{ URL::to('/public/upload/' . $detail->product_image) }}"
                                            data-zoom-image="{{ URL::to('/public/upload/' . $detail->product_image) }}"
                                            style="width: 468px;height: 468px;" alt="product" />
                                    </div>
                                    @foreach ($image_detail as $img1_detail)
                                        <div class="product-item">
                                            <img class="product-single-image"
                                                src="{{ URL::to('/public/upload/product_image/' . $img1_detail->image_url) }}"
                                                data-zoom-image="{{ URL::to('/public/upload/product_image/' . $img1_detail->image_url) }}"
                                                style="width: 468px;height: 468px;" alt="product" />
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="{{ URL::to('/public/upload/' . $detail->product_image) }}"style="width: 110px;height: 110px;"
                                        alt="product-thumbnail" />
                                </div>
                                @foreach ($image_detail as $img_detail)
                                    <div class="owl-dot">
                                        <img src="{{ URL::to('/public/upload/product_image/' . $img_detail->image_url) }}"
                                            style="width: 110px; height: 110px;" alt="product-thumbnail" />
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <!-- End .product-single-gallery -->

                        <div class="col-lg-7 col-md-6 product-single-details">
                            <h1 class="product-title">{{ $detail->product_name }}</h1>



                            <div style="display: flex; align-items: center;">
                                <ul style="display: flex; margin:0px;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            if ($i <= $mean) {
                                                $color = 'color:#706f6c;';
                                            } else {
                                                $color = 'color:#ccc;';
                                            }
                                        @endphp


                                        <li id="" data-index="" data-product_id="" data-rating="" class="rating"
                                            style="cursor: pointer;{{ $color }} font-size: 25px;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                                <!-- End .product-ratings -->

                                | <a href="#" class="rating-link" style="padding-right:1rem;">( {{ $count }}
                                    Đánh giá )</a> |
                                <a href="#" class="rating-link">( {{ $detail->quantity_sold }} Đã bán )</a>
                            </div>
                            <!-- End .ratings-container -->

                            <hr class="short-divider">
                            @if ($detail->promotion_id != 0)
                                @php
                                    $active_promotion_detail = DB::table('tbl_promotion')
                                        ->where('promotion_id', $detail->promotion_id)
                                        ->get();
                                @endphp

                                <div style="background: #fafafa;padding: 15px 20px;" class="price-box">

                                    @foreach ($active_promotion_detail as $v_active_promotion)
                                        @if ($v_active_promotion->promotion_status == 'Có')
                                            @if ($v_active_promotion->promotion_option == '%')
                                                <span style="color:#929292;"
                                                    class="old-price">{{ number_format($detail->product_price, 0, ',', '.') }}VNĐ</span>
                                                <span style="color:red;"
                                                    class="new-price">{{ number_format(($detail->product_price * (100 - $v_active_promotion->promotion_price)) / 100, 0, ',', '.') }}VNĐ</span>
                                            @else
                                                <span style="color:#929292;"
                                                    class="old-price">{{ number_format($detail->product_price, 0, ',', '.') }}VNĐ</span>
                                                <span style="color:red;"
                                                    class="new-price">{{ number_format($detail->product_price - $v_active_promotion->promotion_price, 0, ',', '.') }}VNĐ</span>
                                            @endif
                                        @else
                                            <span style="color:red;"
                                                class="new-price">{{ number_format($detail->product_price, 0, ',', '.') }}VNĐ</span>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div style="background: #fafafa;padding: 15px 20px;" class="price-box">

                                    <span style="color:red;"
                                        class="new-price">{{ number_format($detail->product_price, 0, ',', '.') }}VNĐ</span>
                                </div>
                            @endif
                            <!-- End .price-box -->


                            <!-- End .product-desc -->

                            <ul class="single-info-list">

                                <li>
                                    ID: <strong>{{ $detail->product_id }}</strong>
                                </li>

                                <li>
                                    DANH MỤC:
                                    @if ($detail->category_name == [])
                                        <strong><a class="product-category">
                                                PHỤ KIỆN
                                            </a></strong>
                                    @else
                                        <strong><a href="{{ URL::to('/danh-muc/' . $detail->category_slug) }}"
                                                class="product-category">
                                                {{ $detail->category_name }}
                                            </a></strong>
                                    @endif


                                </li>

                                <li>
                                    THƯƠNG HIỆU: <strong><a href="{{ URL::to('/thuong-hieu/' . $detail->brand_id) }}"
                                            class="product-category">{{ $detail->brand_name }}</a></strong>

                                </li>
                            </ul>

                            <div class="product-action">
                                <?php
                                $sl_qua_lon = Session::get('sl_qua_lon');
                                if ($sl_qua_lon) {
                                    echo "<div class='alert alert-danger'>$sl_qua_lon</div>";
                                    Session::put('sl_qua_lon', null);
                                }
                                ?>
                                <label style="opacity: 0.5;">Còn lại: {{ $detail->product_quantity }}</label><br>
                                <form action="{{ URL::to('/add-cart') }}" method="post" style="margin: 0">
                                    @csrf
                                    <div class="product-single-qty">
                                        <input name="cart_product_qty" min="1"
                                            class="horizontal-quantity form-control cart_product_qty_{{ $detail->product_id }}"
                                            type="text">
                                        <input name="productid_hidden" type="hidden" min="1"
                                            value="{{ $detail->product_id }}" />


                                    </div>
                                    <!-- End .product-single-qty -->

                                    <input type="hidden" name="cart_product_id" value="{{ $detail->product_id }}"
                                        class="cart_product_id_{{ $detail->product_id }}">
                                    <input type="hidden" name="cart_product_name" value="{{ $detail->product_name }}"
                                        class="cart_product_name_{{ $detail->product_id }}">
                                    <input type="hidden" name="cart_product_image" value="{{ $detail->product_image }}"
                                        class="cart_product_image_{{ $detail->product_id }}">
                                    @if ($detail->promotion_id != 0)
                                        @php
                                            $active_promotion_detail = DB::table('tbl_promotion')
                                                ->where('promotion_id', $detail->promotion_id)
                                                ->get();
                                        @endphp
                                        @foreach ($active_promotion_detail as $v_active_promotion)
                                            @if ($v_active_promotion->promotion_status == 'Có')
                                                @if ($v_active_promotion->promotion_option == '%')
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ ($detail->product_price * (100 - $v_active_promotion->promotion_price)) / 100 }}"
                                                        class="cart_product_price_{{ $detail->product_id }}">
                                                @else
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $detail->product_price - $v_active_promotion->promotion_price }}"
                                                        class="cart_product_price_{{ $detail->product_id }}">
                                                @endif
                                            @else
                                                <input type="hidden" name="cart_product_price"
                                                    value="{{ $detail->product_price }}"
                                                    class="cart_product_price_{{ $detail->product_id }}">
                                            @endif
                                        @endforeach
                                    @else
                                        <input type="hidden" name="cart_product_price"
                                            value="{{ $detail->product_price }}"
                                            class="cart_product_price_{{ $detail->product_id }}">
                                    @endif
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    ?>
                                    @if ($customer_id == null)
                                        <a href="{{ URL::to('/login-register') }}" class="btn btn-dark mr-2">ĐĂNG NHẬP ĐỂ
                                            ĐẶT HÀNG</a>
                                    @else
                                        <button type="submit" href="#" class="btn btn-dark mr-2"><span><i
                                                    class="fa-solid fa-cart-shopping"></i> THÊM VÀO GIỎ
                                                HÀNG</span></button>
                                    @endif

                                </form>
                                <form action="{{ URL::to('/add-wishlist') }}" id="form-wishlist" method="post"
                                    style="margin: 0">
                                    @csrf



                                    <input type="hidden" name="cart_product_id" value="{{ $detail->product_id }}"
                                        class="cart_product_id_{{ $detail->product_id }}">
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    ?>
                                    @if ($customer_id == null)
                                    @else
                                        <a id="submit-wishlist" href="#" class="btn-icon-wish add-wishlist"
                                            title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Thêm vào
                                                Wishlist</span></a>
                                    @endif

                                </form>
                            </div>


                        </div>
                        <!-- End .product-single-details -->
                    </div>

                    {{-- </form> --}}
                @endforeach
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->
            @if ($promotion_accessory != '')
            <hr style="margin: 1rem 0 1rem 0">
                <div class="products-section pt-0">
                    <h2 style="text-align: center;" class="section-title">
                        {{ $promotion_accessory->promotion_accessory_des }}</h2>

                    <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                        @foreach ($product_by_product_ids as $key => $v_product_by_product_ids)
                            <div class="product-default">
                                <figure>
                                    <a href="{{ URL::to('/san-pham/' . $v_product_by_product_ids->product_slug) }}">
                                        <img src="{{ URL::to('/public/upload/' . $v_product_by_product_ids->product_image) }}"
                                            style="width: 280px; height: 280px;"alt="product">
                                        <img src="{{ URL::to('/public/upload/' . $v_product_by_product_ids->product_image) }}"
                                            style="transform: scaleX(-1);width: 280px; height: 280px;"alt="product">
                                    </a>
                                    {{-- @if ($v_product_by_product_ids->product_status == '1')
                                    <div class="label-group">
                                        <div class="product-label label-hot"> 
                                            Giảm: {{ round(100 - (($v_product_by_product_ids->product_sale_price / $v_product_by_product_ids->product_price) * 100)) }}%
                                        </div>
                                    </div>
                                @else
                                @endif --}}

                                </figure>
                                <div class="product-details">

                                    <h3 class="product-title">
                                        <a
                                            href="{{ URL::to('/san-pham/' . $v_product_by_product_ids->product_slug) }}">{{ $v_product_by_product_ids->product_name }}</a>
                                    </h3>

                                    <!-- End .product-container -->
                                    @if ($promotion_accessory->promotion_accessory_status == 'Có')
                                        <div class="price-box">

                                            @if ($promotion_accessory->promotion_accessory_option == '%')
                                                <del
                                                    class="old-price">{{ number_format($v_product_by_product_ids->product_price) }}</del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format(($v_product_by_product_ids->product_price * (100 - $promotion_accessory->promotion_accessory_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                            @elseif($promotion_accessory->promotion_accessory_option == 'VNĐ')
                                                <del
                                                    class="old-price">{{ number_format($v_product_by_product_ids->product_price) }}</del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($v_product_by_product_ids->product_price - $promotion_accessory->promotion_accessory_price) . ' ' . 'VNĐ' }}</span>
                                            @else
                                                <del class="old-price"></del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($v_product_by_product_ids->product_price) . ' ' . 'VNĐ' }}</span>
                                            @endif

                                        </div>
                                    @else
                                        <div class="price-box">
                                            <del class="old-price"></del><br>
                                            <span style="color:red;"
                                                class="product-price">{{ number_format($v_product_by_product_ids->product_price) . ' ' . 'VNĐ' }}</span>
                                        </div>
                                    @endif
                                    <p style="color:#999;font-size: 1.4rem;">Đã bán:
                                        {{ $v_product_by_product_ids->quantity_sold }}
                                    </p>

                                    <!-- End .price-box -->
                                    <div class="product-action">

                                        <form action="{{ URL::to('/add-cart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_product_id"
                                                value="{{ $v_product_by_product_ids->product_id }}"
                                                class="cart_product_id_{{ $v_product_by_product_ids->product_id }}">
                                            <input type="hidden" name="cart_product_name"
                                                value="{{ $v_product_by_product_ids->product_name }}"
                                                class="cart_product_name_{{ $v_product_by_product_ids->product_id }}">
                                            <input type="hidden" name="cart_product_image"
                                                value="{{ $v_product_by_product_ids->product_image }}"
                                                class="cart_product_image_{{ $v_product_by_product_ids->product_id }}">

                                            @if ($promotion_accessory->promotion_accessory_status == 'Có')
                                                @if ($promotion_accessory->promotion_accessory_option == '%')
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ ($v_product_by_product_ids->product_price * (100 - $promotion_accessory->promotion_accessory_price)) / 100 }}"
                                                        class="cart_product_price_{{ $v_product_by_product_ids->product_id }}">
                                                @elseif ($promotion_accessory->promotion_accessory_option == 'VNĐ')
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $v_product_by_product_ids->product_price - $promotion_accessory->promotion_accessory_price }}"
                                                        class="cart_product_price_{{ $v_product_by_product_ids->product_id }}">
                                                @else
                                                    <input type="hidden" name="cart_product_price"
                                                        value="{{ $v_product_by_product_ids->product_price }}"
                                                        class="cart_product_price_{{ $v_product_by_product_ids->product_id }}">
                                                @endif
                                            @else
                                                <input type="hidden" name="cart_product_price"
                                                    value="{{ $v_product_by_product_ids->product_price }}"
                                                    class="cart_product_price_{{ $v_product_by_product_ids->product_id }}">
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


                </div>
            @else
            @endif

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Mô tả chi tiết</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-comment-content"
                            role="tab" aria-controls="product-size-content" aria-selected="true">Bình luận</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                            role="tab" aria-controls="product-reviews-content" aria-selected="false">Đánh giá</a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                        aria-labelledby="product-tab-desc">
                        <div class="product-desc-content"
                            style="background: #f4f4f4; color: black; padding: 1px 20px 1px 20px;">
                            <p>{!! $detail->product_desc !!}</p>

                        </div>
                        <!-- End .product-desc-content -->
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-comment-content" role="tabpanel"
                        aria-labelledby="product-tab-size">
                        <div class="product-reviews-content">
                            @php
                                use Carbon\Carbon;
                            @endphp
                            <div class="comment-list">

                                @foreach ($comment as $v_comment)
                                    <div class="comments mb-2">
                                        <figure class="img-thumbnail">
                                            <img src="{{ asset('public/frontend/assets/images/rating_comment_user.png') }}"
                                                alt="author" width="80" height="80">
                                        </figure>

                                        <div class="comment-block">
                                            <div class="comment-header">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
                                                    @php
                                                        $customer = DB::table('tbl_customers')
                                                            ->where('customer_id', $v_comment->customer_id)
                                                            ->first();
                                                    @endphp
                                                    <strong>{{ $customer->customer_name }}</strong>

                                                    {{ $v_comment->created_at ? Carbon::parse($v_comment->created_at)->format('H:i d/m/Y') : 'N/A' }}
                                                </span>
                                            </div>

                                            <div class="comment-content">
                                                <p>{{ $v_comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div style="float: right;">{{ $comment->linkS() }}</div>
                            <div class="add-product-review">
                                <h3 class="review-title">Thêm bình luận</h3>

                                <form action="{{ URL::to('/comment') }}" class="comment-form m-0" method="get">
                                    @foreach ($product_detail as $item)
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    @endforeach

                                    <div class="form-group">
                                        <label>Bình luận: </label>
                                        <textarea cols="5" rows="6" name="comment" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <!-- End .form-group -->



                                    <div style="text-align: right;">
                                        @if (Session::get('customer_id') == null)
                                            <a href="{{ url('/login-register') }}" class="btn btn-primary">Đăng nhập để
                                                bình luận</a>
                                        @else
                                            <input type="submit" class="btn btn-primary" value="Bình luận">
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <!-- End .row -->
                        </div>
                        <!-- End .product-size-content -->
                    </div>
                    <!-- End .tab-pane -->



                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                        aria-labelledby="product-tab-reviews">
                        <div class="product-reviews-content">

                            <div class="comment-list">

                                @foreach ($rating as $v_rating)
                                    <div class="comments mb-2">
                                        <figure class="img-thumbnail">
                                            <img src="{{ asset('public/frontend/assets/images/rating_comment_user.png') }}"
                                                alt="author" width="80" height="80">
                                        </figure>

                                        <div class="comment-block">
                                            <div class="comment-header">
                                                <div class="comment-arrow"></div>

                                                <div class="ratings-container float-sm-right">
                                                    <ul style="display: flex;">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @php
                                                                if ($i <= $v_rating->rating_start) {
                                                                    $color = 'color:#706f6c;';
                                                                } else {
                                                                    $color = 'color:#ccc;';
                                                                }
                                                            @endphp


                                                            <li id="" data-index="" data-product_id=""
                                                                data-rating="" class="rating"
                                                                style="cursor: pointer;{{ $color }} font-size: 25px;">
                                                                &#9733;
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <!-- End .product-ratings -->
                                                </div>

                                                <span class="comment-by">
                                                    @php
                                                        $customer = DB::table('tbl_customers')
                                                            ->where('customer_id', $v_rating->customer_id)
                                                            ->first();
                                                    @endphp
                                                    <strong>{{ $customer->customer_name }}</strong>

                                                    {{ $v_rating->rating_created_at ? Carbon::parse($v_rating->rating_created_at)->format('H:i d/m/Y') : 'N/A' }}
                                                </span>
                                            </div>

                                            <div class="comment-content">
                                                <p>{{ $v_rating->rating_review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div style="float: right;">{{ $rating->linkS() }}</div>

                            <div class="add-product-review">
                                <h3 class="review-title">Thêm đánh giá</h3>

                                <form action="{{ URL::to('/rating') }}" class="comment-form m-0" method="get">
                                    @foreach ($product_detail as $item)
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    @endforeach
                                    <div class="rating-form">
                                        <label for="rating">Đánh giá: <span class="required">*</span></label>
                                        <span class="rating-stars">
                                            <a class="star-1" href="#">1</a>
                                            <a class="star-2" href="#">2</a>
                                            <a class="star-3" href="#">3</a>
                                            <a class="star-4" href="#">4</a>
                                            <a class="star-5" href="#">5</a>
                                        </span>

                                        <select name="rating_start" id="rating" required=""
                                            style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Bình luận: <span class="required">*</span></label>
                                        <textarea cols="5" rows="6" name="rating_review" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <!-- End .form-group -->



                                    <div style="text-align: right;">
                                        @if (Session::get('customer_id') == null)
                                            <a href="{{ url('/login-register') }}" class="btn btn-primary">Đăng nhập để
                                                đánh giá</a>
                                        @else
                                            @if (Session::get('order_status') == 'rỗng')
                                                <label for="">Vui lòng mua hàng để có thể đánh giá</label>
                                            @else
                                                @foreach ($status_order as $v_status_order)
                                                    @if ($v_status_order->order_status == 'Đã nhận hàng')
                                                        <input type="submit" class="btn btn-primary" value="Đánh giá">
                                                    @else
                                                        <label for="">Vui lòng mua hàng để có thể đánh giá</label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <!-- End .add-product-review -->
                        </div>
                        <!-- End .product-reviews-content -->
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>

            <!-- End .product-single-tabs -->
            <div class="products-section pt-0">
                <h2 style="text-align: center;" class="section-title">Sản phẩm tương tự</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach ($related_product as $key => $related_product)
                        <div class="product-default">
                            <figure>
                                <a href="{{ URL::to('/san-pham/' . $related_product->product_slug) }}">
                                    <img src="{{ URL::to('/public/upload/' . $related_product->product_image) }}"
                                        style="width: 280px; height: 280px;"alt="product">
                                    <img src="{{ URL::to('/public/upload/' . $related_product->product_image) }}"
                                        style="transform: scaleX(-1);width: 280px; height: 280px;"alt="product">
                                </a>
                                {{-- @if ($related_product->product_status == '1')
                                    <div class="label-group">
                                        <div class="product-label label-hot"> 
                                            Giảm: {{ round(100 - (($related_product->product_sale_price / $related_product->product_price) * 100)) }}%
                                        </div>
                                    </div>
                                @else
                                @endif --}}

                            </figure>
                            <div class="product-details">
                               
                                <h3 class="product-title">
                                    <a
                                        href="{{ URL::to('/san-pham/' . $related_product->product_slug) }}">{{ $related_product->product_name }}</a>
                                </h3>
                                <div class="ratings-container">
                                    <ul style="display: flex;">
                                        @php
                                            $count_related_product = 0;
                                            $mean_related_product = 0;
                                            $total_start_related_product = 0;
                                            $rating = DB::table('tbl_rating')

                                                ->where('product_id', $related_product->product_id)
                                                ->orderBy('rating_id', 'desc')
                                                ->get();

                                            foreach ($rating as $key => $v_rating) {
                                                $count_related_product++;
                                                $total_start_related_product += $v_rating->rating_start;
                                            }

                                            if ($count_related_product == 0) {
                                                $mean_related_product = round($total_start_related_product);
                                            } else {
                                                $mean_related_product = round(
                                                    $total_start_related_product / $count_related_product,
                                                );
                                            }

                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                if ($i <= $mean_related_product) {
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
                                @if ($related_product->promotion_id != 0)
                                    @php
                                        $active_promotion_new = DB::table('tbl_promotion')
                                            ->where('promotion_id', $related_product->promotion_id)
                                            ->get();
                                    @endphp
                                    <div class="price-box">
                                        @foreach ($active_promotion_new as $v_active_promotion)
                                            @if ($v_active_promotion->promotion_status == 'Có')
                                                @if ($v_active_promotion->promotion_option == '%')
                                                    <del
                                                        class="old-price">{{ number_format($related_product->product_price) }}</del><br>
                                                    <span style="color:red;"
                                                        class="product-price">{{ number_format(($related_product->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                                @else
                                                    <del
                                                        class="old-price">{{ number_format($related_product->product_price) }}</del><br>
                                                    <span style="color:red;"
                                                        class="product-price">{{ number_format($related_product->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
                                                @endif
                                            @else
                                                <del class="old-price"></del><br>
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($related_product->product_price) . ' ' . 'VNĐ' }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="price-box">
                                        <del class="old-price"></del><br>
                                        <span style="color:red;"
                                            class="product-price">{{ number_format($related_product->product_price) . ' ' . 'VNĐ' }}</span>
                                    </div>
                                @endif
                                <p style="color:#999;font-size: 1.4rem;">Đã bán: {{ $related_product->quantity_sold }}
                                </p>

                                <!-- End .price-box -->
                                <div class="product-action">

                                    <a href="{{ URL::to('/san-pham/' . $related_product->product_slug) }}"
                                        class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>Xem chi
                                            tiết</span></a>

                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach
                </div>

                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->


            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>

    <script>
        document.getElementById('submit-wishlist').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a
            document.getElementById('form-wishlist').submit(); // Kích hoạt submit của form
        });
    </script>
@endsection
