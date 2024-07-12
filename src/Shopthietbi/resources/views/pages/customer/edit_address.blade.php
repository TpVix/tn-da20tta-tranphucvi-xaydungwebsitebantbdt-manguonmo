
@extends('pages.layout.layout')
@section('content')

<div id="shipping" role="tabpanel">
    <div class="address account-content mt-0 pt-2">
        <h4 class="title mb-3">Chỉnh sửa địa chỉ</h4>
        @foreach ($edit_address as $key => $edit_address)
        <form>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Họ và tên <span class="required">*</span></label>
                        <input  name="address_name" value="{{($edit_address-> address_name)}}" type="text" class="form-control address_name" required />
                    </div>
                </div>

        
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tỉnh/thành phố <span class="required">*</span></label>
                 
                        <select name="city" id="city" class="form-control chose city">
                       

                            @foreach ($city as $citys)
                            @if ($citys->matp == $edit_address->matp)
                            <option value="{{ $citys->matp }}" selected>{{ $citys->name_tinhthanhpho }}</option>
                            @else
                            <option value="{{ $citys->matp }}">{{ $citys->name_tinhthanhpho }}</option>
                            @endif
                                
                            @endforeach



                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quận/huyện <span class="required">*</span></label>
                    
                        <select name="district" id="district" class="form-control chose district">
                            @php
                                // Lấy danh sách các quận/huyện thuộc thành phố được chọn
                                $city_districts = DB::table('tbl_quanhuyen')->orderBy('maqh', 'ASC')->where('matp', $edit_address->matp)->get();
                            @endphp
                        
                            @foreach ($city_districts as $city_district)
                                <option value="{{ $city_district->maqh }}" {{ $city_district->maqh == $edit_address->maqh ? 'selected' : '' }}>
                                    {{ $city_district->name_quanhuyen }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Xã/phường/thị trấn<span class="required">*</span></label>
          
                        <select name="ward" id="ward" class="form-control ward ">
                      
                            @php
                            // Lấy danh sách các quận/huyện thuộc thành phố được chọn
                            $districts_ward = DB::table('tbl_xaphuongthitran')->orderBy('xaid', 'ASC')->where('maqh', $edit_address->maqh)->get();
                            @endphp
                        
                            @foreach ($districts_ward as $districts_ward)
                                <option value="{{ $districts_ward->xaid }}" {{ $districts_ward->xaid == $edit_address->xaid ? 'selected' : '' }}>
                                    {{ $districts_ward->name_xaphuongthitran }}
                                </option>
                            @endforeach

                            
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Số điện thoại <span class="required">*</span></label>
                        <input name="address_phone" value="{{($edit_address-> address_phone)}}" type="text" class="form-control address_phone" required />
                    </div>
                </div>

               
            </div>

            <div class="form-footer mb-0">
                <div class="form-footer-right">
                    <button type="button" class="btn btn-dark py-4 update_address">
                        Cập nhật địa chỉ
                    </button>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div><!-- End .tab-pane -->

@endsection