@extends('pages.layout.layout')
@section('content')
    <div id="shipping" role="tabpanel">
        <div class="address account-content mt-0 pt-2">
            <h4 class="title mb-3">Thêm địa chỉ</h4>

            <form>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Họ và tên <span class="required">*</span></label>
                            <input name="address_name" type="text" class="form-control address_name" required />
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tỉnh/thành phố <span class="required">*</span></label>
                     
                            <select name="city" id="city" class="form-control chose city">
                                <option>--Chọn tỉnh/thành phố--</option>

                                @foreach ($city as $citys)
                                    <option value="{{ $citys->matp }}">{{ $citys->name_tinhthanhpho }}</option>
                                @endforeach



                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quận/huyện <span class="required">*</span></label>
                        
                            <select name="district" id="district" class="form-control chose district">
                                <option>--Chọn quận/huyện--</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Xã/phường/thị trấn<span class="required">*</span></label>
              
                            <select name="ward" id="ward" class="form-control ward ">
                                <option>--Chọn xã/phường/thị trấn--</option>


                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số điện thoại <span class="required">*</span></label>
                            <input name="address_phone" type="text" class="form-control address_phone" required />
                        </div>
                    </div>

                    
                </div>

                <div class="form-footer mb-0">
                    <div class="form-footer-right">
                        <button type="button" class="btn btn-dark py-4 add_address">
                            Lưu địa chỉ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- End .tab-pane -->
@endsection
