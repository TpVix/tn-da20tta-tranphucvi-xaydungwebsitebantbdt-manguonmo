@extends('admin_layout')
@section('main_admin')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Phí vận chuyển</h1>
           
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Thêm phí vận chuyển</h4>

                        <form>
                            @csrf
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Tên tỉnh/thành phố</label> 
                                  <select name="city" id="city" class="form-select chose city">
                                    <option >--Chọn tỉnh/thành phố--</option>
                              
                                   @foreach ($city as $citys)
                                       <option value="{{$citys->matp}}">{{$citys->name_tinhthanhpho}}</option>
                                   @endforeach
                                        
                                   
    
                                </select>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-12 col-form-label">Quận/huyện</label> 
                                <select name="district" id="district" class="form-select chose district">
                                    <option >--Chọn quận/huyện--</option> 
                                        
                                
                                </select>
                            </div> 
                            <div class="form-group row">
                                <label for="slug" class="col-12 col-form-label">Tên xã/phường/thị trấn</label> 
                                <select name="ward" id="ward" class="form-select ward ">
                                    <option >--Chọn xã/phường/thị trấn--</option> 
                                       
                                   
            
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-form-label">Phí vận chuyển</label>
                                <div class="col-12">
                                    <input type="text" class="form-control shipping_fee_price" id="group_tag" name="group_tag" value="" placeholder="" data-role="tagsinput">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button name="add_delivery" type="button" class="btn btn-primary add_delivery">Thêm phí vận chuyển</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div id="load_delivery" class="table-responsive">
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection