@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>Danh sách khách hàng</h1>
                
            </div>
         
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table id="" class="table table_data">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;!important">Tên</th>
                                        <th>Email</th>
                                        <th>Số đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày tạo</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        use Carbon\Carbon;
                                    @endphp
                                    @foreach ($customer_all as $all)
                                    @php
                                    $customer=DB::table('tbl_customers')
                                    ->join('tbl_order','tbl_order.customer_id','=','tbl_customers.customer_id')
                                    ->where('tbl_customers.customer_id',$all->customer_id)
                                    ->get();
                                    
                                    foreach ($customer as $key => $v_customer) {
                                       
                                        
                                    }
                                   
                                    @endphp
                                        <tr>



                                           
                                            <td>{{ $v_customer->customer_name }}</td>
                                            <td>{{ $v_customer->customer_email }}</td>


                                            <td>
                                                {{ $all->order_count}}

                                            </td>
                                            <td>
                                                {{number_format($all->total_order_amount) . ' ' . 'VNĐ' }}
                                            </td>
                                            <td>{{ $v_customer->created_at ? Carbon::parse($v_customer->created_at)->format('d/m/Y') : 'N/A' }}
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add User Modal  -->
       
    </div>
@endsection
