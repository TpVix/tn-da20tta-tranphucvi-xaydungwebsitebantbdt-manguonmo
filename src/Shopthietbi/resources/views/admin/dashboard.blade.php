@extends('admin_layout')
@section('main_admin')
    
<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div class="card-body">
                    <h2 class="mb-1">{{$count_customer}}</h2>
                    <p>Tổng khách hàng</p>
                    <span class="mdi mdi-account-arrow-left"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">{{$daily_order}}</h2>
                    <p>Đơn hàng hôm nay</p>
                    <span class="mdi mdi-package-variant"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-4">
                <div class="card-body">
                    <h2 class="mb-1">{{ number_format($total, 0, ',', '.') }}đ</h2>
                    <p>Doanh thu hôm nay</p>
                    <span class="mdi mdi-currency-usd"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-4">
                <div class="card-body">
                    <h2 class="mb-1">{{ number_format($all_total, 0, ',', '.') }}đ</h2>
                    <p>Tổng doanh thu</p>
                    <span class="mdi mdi-currency-usd"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- <div class="col-xl-8 col-md-12 p-b-15">
            <!-- Sales Graph -->
            <div id="user-acquisition" class="card card-default">
                <div class="card-header">
                    <h2>Sales Report</h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
                                aria-selected="true">Today's</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
                                aria-selected="false">Monthly </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
                                aria-selected="false">Yearly</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="salesReport">
                        <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                            <div class="mb-6" style="max-height:247px">
                                <canvas id="acquisition" class="chartjs2"></canvas>
                                <div id="acqLegend" class="customLegend mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-8 col-md-12 p-b-15">
            <div class="card card-default">
                <div class="card-header flex-column align-items-start">
                    <h2>Tổng đơn hàng theo ngày</h2>
                </div>
                <div class="card-body">
                    <canvas id="currentUser" class="chartjs"></canvas>
                </div>
               
            </div>
        </div>
        <div class="col-xl-4 col-md-12 p-b-15">
            <!-- Doughnut Chart -->
            <div class="card card-default">
                <div class="card-header justify-content-center">
                    <h2>Tình trạng đơn hàng</h2>
                </div>
                <div class="card-body">
                    <canvas id="doChart"></canvas>
                </div>
                
                <div class="card-footer d-flex flex-wrap bg-white p-0">
                    <div class="col-12">
                        <div class="p-20">
                            <ul >
                                @foreach($order_status_counts as $status)
                                <li class="mb-2">
                                    <i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                       style="color: {{ $order_status_colors[$status['order_status']] }}"></i>
                                        {{ ucfirst($status['order_status']) }}
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-b-15">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Đơn hàng gần đây</h2>
                    
                </div>
                <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tài khoản</th>
                                <th class="d-none d-lg-table-cell">Số lượng</th>
                                <th class="d-none d-lg-table-cell">Ngày đặt hàng</th>
                                <th class="d-none d-lg-table-cell">Đơn giá</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_order as $v_all_order)
                               <tr>
                                <td>{{$v_all_order->order_name}}</td>
                                <td>
                                    <a class="text-dark" href="#"> {{$v_all_order->customer_name}}</a>
                                </td>
                                <td class="d-none d-lg-table-cell">{{$v_all_order->order_quantity}}</td>
                                <td class="d-none d-lg-table-cell">{{$v_all_order->created_at}}</td>
                                <td class="d-none d-lg-table-cell">{{ number_format($v_all_order->order_total, 0, ',', '.') }}đ</td>
                                <td>
                                    <span class="badge badge-success">{{$v_all_order->payment_status}}</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#"
                                            role="button" id="dropdown-recent-order1"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="{{url('/view-order/'.$v_all_order->order_id)}}">Chi tiết</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </td>
                            </tr> 
                            @endforeach
                            
 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-5">
            <!-- New Customers -->
            <div class="card ec-cust-card card-table-border-none card-default">
                <div class="card-header justify-content-between ">
                    <h2>Khách hàng tiềm năng</h2>
                </div>
                <div class="card-body pt-0 pb-15px">
                    <table class="table ">
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($potential_customer as $v_potential_customer)
                            @php
                                $customer=DB::table('tbl_customers')
                                ->join('tbl_order','tbl_order.customer_id','=','tbl_customers.customer_id')
                                ->where('tbl_customers.customer_id',$v_potential_customer->customer_id)
                                ->get();
                                
                                foreach ($customer as $key => $v_customer) {
                                   
                                    
                                }
                               
                            @endphp
                            
                            <tr>
                                <td>
                                    <div class="media">
                                        
                                        <div class="media-body align-self-center">
                                            <a href="profile.html">
                                                <h6 class="mt-0 text-dark font-weight-medium">{{$v_customer->customer_name}}</h6>
                                            </a>
                                            <small>{{$v_customer->customer_email}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Đơn hàng: {{$v_potential_customer->order_count}}</td>
                                <td class="text-dark d-none d-md-block">{{number_format($v_potential_customer->total_order_amount) . ' ' . 'VNĐ' }}</td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <!-- Top Products -->
            <div class="card card-default ec-card-top-prod">
                <div class="card-header justify-content-between">
                    <h2>Sản phẩm bán chạy</h2>
                    
                </div>
                <div class="card-body mt-10px mb-10px py-0">
                    @foreach ($selling_products as $v_selling_products)
                    <div class="row media d-flex pt-15px pb-15px">
                        <div
                            class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                            <a href="#"><img src="{{asset('public/upload/'.$v_selling_products-> product_image)}}" alt="customer image"></a>
                        </div>
                        <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                            <a href="#">
                                <h6 class="mb-10px text-dark font-weight-medium col-lg-9">{{$v_selling_products->product_name}}</h6>
                            </a>
                            <p class="float-md-right sale"><span class="mr-2">{{$v_selling_products->quantity_sold}}</span>đã bán</p>
                            <p class="mb-0 ec-price">
                                @if ($v_selling_products->promotion_id != 0)
                                    @php
                                        $active_promotion_new = DB::table('tbl_promotion')
                                            ->where('promotion_status', 'Có')
                                            ->where('promotion_id', $v_selling_products->promotion_id)
                                            ->get();
                                    @endphp
                                    <div class="price-box">
                                        <del class="old-price">{{ number_format($v_selling_products->product_price) }}</del><br>
                                        @foreach ($active_promotion_new as $v_active_promotion)
                                            @if ($v_active_promotion->promotion_option == '%')
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format(($v_selling_products->product_price * (100 - $v_active_promotion->promotion_price)) / 100) . ' ' . 'VNĐ' }}</span>
                                            @else
                                                <span style="color:red;"
                                                    class="product-price">{{ number_format($v_selling_products->product_price - $v_active_promotion->promotion_price) . ' ' . 'VNĐ' }}</span>
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
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        window.orderStatusCounts = @json($order_status_counts);
        window.orderStatusColors = @json($order_status_colors);
        window.orderCountsday = @json($order_counts_day);
    </script>
</div> <!-- End Content -->

@endsection