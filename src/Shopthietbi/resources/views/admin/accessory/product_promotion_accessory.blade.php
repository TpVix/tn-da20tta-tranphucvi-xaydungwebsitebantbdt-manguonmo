@extends('admin_layout')
@section('main_admin')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Sản phẩm khuyến mãi cho thương hiệu {{$promotion_accessory_name->brand_name}}</h1>
            
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <?php
                            $chose = Session::get('chose_success');
                            if ($chose) {
                                echo "<div class='alert alert-success'>$chose</div>";
                                Session::put('chose_success', null);
                            }
                            ?>
                        <div class="table-responsive ">
                            <span style="margin: auto;"><input id="select_all_ids" type="checkbox"/> tất cả</span>
                            <a href="#" class="btn btn-outline-success" id="chose_all_promotion_accessory" ui-toggle-class="">
                                Chọn <i class="fa fa-pencil-square-o text-success text-active"></i>
                             </a>
                            <table id="" class="table table_data"
                              style="width:100%">
                              <thead>
                                <tr>
                                    <th></th>
                                  <th>Hình ảnh</th>
                                  <th>Tên sản phẩm</th>
                          
                                  <th>Giá</th>
                              
                                  {{-- <th>Nhóm phụ kiện</th> --}}
                                  
                                 
                                  
                                </tr>
                              </thead>
                
                              <tbody>
                                @php
                                $product_ids_with_accessory = $promotion_accessory_ids->pluck('product_id')->toArray();
                                @endphp
                                @foreach ($all_product as $key => $product)
                                @if (!in_array($product->product_id, $product_ids_with_accessory))
                                    <tr>
                                        <td><input type="checkbox" name="ids" class="checkbox_ids" value="{{$product ->product_id}}"></td>
                                        <td><img src="{{ url('public/upload/' . $product->product_image) }}" height="100" width="100" alt=""></td>
                                    <td>{{ $product -> product_name}}</td>
                                
                                    <td>{{ $product -> product_price}}</td>
                               
                                    {{-- <td>{{ $product -> accessory_name}}</td> --}}
                                                                     
                                    
                                      </tr>
                                      @endif
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table_data">
                                <thead>
                                    <tr>
                                        <th>Hình</th>
                                        <th>Tên</th>
                                        

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($product_promotion_accessory as $v_product_promotion_accessory)
                                        <tr>
                                            <td><img src="{{ url('public/upload/' . $v_product_promotion_accessory->product_image) }}" height="100" width="100" alt=""></td>

                                            <td>{{ $v_product_promotion_accessory->product_name }}</td>

                                            
                                            <td>
                                                <div class="btn-group">
                                                    <a onclick="return confirm('Bạn có chắc muốn xoá ?')" href="{{URL::to('/delete-product-promotion-accessory/'.$v_product_promotion_accessory->product_id)}}" class="btn btn-outline-danger">Xoá</a>
                                                    
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
        </div>
        
    </div>
@endsection
