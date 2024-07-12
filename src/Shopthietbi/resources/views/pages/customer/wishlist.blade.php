
@extends('layout')
@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">TRANG CHỦ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Danh sách mong đợi
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Danh sách mong đợi</h1>
        </div>
    </div>

    <div class="container">
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Tên sản phẩm</th>
                        <th class="price-col">Giá</th>
                        <th class="status-col">Trạng thái</th>
                        <th class="status-col">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_wishlist as $key =>$v_product_wishlist )
                    <tr class="product-row">
                        <td>
                            <figure class="product-image-container">
                                <a href="{{URL::to('/san-pham/'.$v_product_wishlist-> product_slug)}}" class="product-image">
                                    <img src="{{asset('public/upload/'.$v_product_wishlist-> product_image)}}" alt="product">
                                </a>

                                <a href="{{URL::to('/delete-wishlist/'.$v_product_wishlist-> product_id)}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                            </figure>
                        </td>
                        <td>
                            <h5 class="product-title">
                                <a href="{{URL::to('/san-pham/'.$v_product_wishlist-> product_slug)}}">{{($v_product_wishlist -> product_name)}}</a>
                            </h5>
                        </td>
                        <td class="price-box">
                            @if ($v_product_wishlist->promotion_id != 0)
                                @php
                                    $active_promotion_detail = DB::table('tbl_promotion')
                                        ->where('promotion_id', $v_product_wishlist->promotion_id)
                                        ->get();
                                @endphp

                                <div style="background: #fafafa;padding: 15px 20px;" class="price-box">

                                    @foreach ($active_promotion_detail as $v_active_promotion)
                                        @if ($v_active_promotion->promotion_status == 'Có')
                                            @if ($v_active_promotion->promotion_option == '%')
                                                <span style="color:#929292;"
                                                    class="old-price">{{ number_format($v_product_wishlist->product_price, 0, ',', '.') }}VNĐ</span>
                                                <span style="color:red;"
                                                    class="new-price">{{ number_format(($v_product_wishlist->product_price * (100 - $v_active_promotion->promotion_price)) / 100, 0, ',', '.') }}VNĐ</span>
                                            @else
                                                <span style="color:#929292;"
                                                    class="old-price">{{ number_format($v_product_wishlist->product_price, 0, ',', '.') }}VNĐ</span>
                                                <span style="color:red;"
                                                    class="new-price">{{ number_format($v_product_wishlist->product_price - $v_active_promotion->promotion_price, 0, ',', '.') }}VNĐ</span>
                                            @endif
                                        @else
                                            <span style="color:red;"
                                                class="new-price">{{ number_format($v_product_wishlist->product_price, 0, ',', '.') }}VNĐ</span>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div style="background: #fafafa;padding: 15px 20px;" class="price-box">

                                    <span style="color:red;"
                                        class="new-price">{{ number_format($v_product_wishlist->product_price, 0, ',', '.') }}VNĐ</span>
                                </div>
                            @endif
                        </td>
                        
                        <td>
                            <span class="stock-status">
                            @if ($v_product_wishlist -> product_quantity=="0")
                                Hết hàng
                            @else
                                Còn hàng
                            @endif    
                            
                            
                            </span>
                        </td>
                        <td>
                            <span class="stock-status">
                        
                                Còn lại: {{$v_product_wishlist -> product_quantity}}
                            
                            
                            
                            </span>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main>
@endsection