<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from maraviyainfotech.com/projects/ekka/ekka-v37/ekka-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 11:30:47 GMT -->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard eCommerce HTML Template.">

	<title>Trang Admin</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet"> 

	<link href="{{asset('public/backend/assets/css/materialdesignicons.min.css')}}" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="{{asset('public/backend/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
	<link href="{{asset('public/backend/assets/plugins/simplebar/simplebar.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('public/frontend/assets/css/sweetalert.css')}}">

	<!-- Ekka CSS -->
	<link id="ekka-css" href="{{asset('public/backend/assets/css/ekka.css')}}" rel="stylesheet" />
	<link id="ekka-css" href="{{asset('public/backend/assets/css/datatable.min.css')}}" rel="stylesheet" />
	<!-- FAVICON -->
	<link href="{{asset('public/backend/assets/img/favicon.png')}}')}}" rel="shortcut icon" />

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
		
		<!-- LEFT MAIN SIDEBAR -->
		<div class="ec-left-sidebar ec-bg-sidebar">
			<div id="sidebar" class="sidebar ec-sidebar-footer">

				<div class="ec-brand d-flex justify-content-center" >
					
					<div class="ec-brand" >
						<a href="{{url('/dashboard')}}" title="Ekka" style="padding: 0px;width:100%;">
							
						
							<img class="ec-brand-name text-truncate" src="{{asset('public/frontend/assets/images/logo.png')}}" style="width:75px;height: 75px;" alt="" />

						</a>
					</div>
				
				</div>

				<!-- begin sidebar scrollbar -->
				<div class="ec-navigation" data-simplebar>
					<!-- sidebar menu -->
					<ul class="nav sidebar-inner" id="sidebar-menu">
						<!-- Dashboard -->
						<li class="active">
							<a class="sidenav-item-link" href="{{URL::to('/dashboard')}}">
								<i class="mdi mdi-view-dashboard-outline"></i>
								<span class="nav-text">Thống kê</span>
							</a>
							<hr>
						</li>

						<!-- Users -->
						
							<li class="has-sub active">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="mdi mdi-account-group"></i>
									<span class="nav-text">Tài khoản</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="users" data-parent="#sidebar-menu">
										

										<li class="">
											<a class="sidenav-item-link" href="{{URL::to('/list-account')}}">
												<span class="nav-text">Tài khoản admin</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="{{URL::to('/list-customer')}}">
												<span class="nav-text">Tài khoản khách hàng</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
						
						

						<!-- Category -->
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-dns-outline"></i>
								<span class="nav-text">Danh mục</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/add-category-product')}}">
											<span class="nav-text">Thêm danh mục</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-category-product')}}">
											<span class="nav-text">Xem danh mục</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="active">
							<a class="sidenav-item-link" href="{{url('/add-accessory')}}">
								<i class="mdi mdi-tag-minus"></i>
								<span class="nav-text">Nhóm phụ kiện</span>
							</a>
						</li>
                        <!-- Brands -->
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-tag-faces"></i>
								<span class="nav-text">Thương hiệu</span><b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/add-brand')}}">
											<span class="nav-text">Thêm thương hiệu</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-brand')}}">
											<span class="nav-text">Xem thương hiệu</span>
										</a>
									</li>
								</ul>
							</div>
							
						</li>
                        <li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-sort-variant"></i>
								<span class="nav-text">Slider</span><b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/add-slider')}}">
											<span class="nav-text">Thêm Slider</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-slider')}}">
											<span class="nav-text">Xem Slider</span>
										</a>
									</li>
								</ul>
							</div>
							
						</li>
						<!-- Products -->
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-palette-advanced"></i>
								<span class="nav-text">Sản phẩm</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/add-product')}}">
											<span class="nav-text">Thêm Sản phẩm</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-product')}}">
											<span class="nav-text">Xem Sản phẩm</span>
										</a>
									</li>
									{{-- <li class="">
										<a class="sidenav-item-link" href="product-grid.html">
											<span class="nav-text">Grid Product</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="product-detail.html">
											<span class="nav-text">Product Detail</span>
										</a>
									</li> --}}
								</ul>
							</div>
						</li>

						<!-- Orders -->
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-basket"></i>
								<span class="nav-text">Đơn hàng</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/manage-order')}}">
											<span class="nav-text">Quản lý đơn hàng</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						
						<li class="has-sub active">
							<a class="sidenav-item-link" href="{{URL::to('/manage-delivery')}}">
								<i class="mdi mdi-car-estate"></i>
								<span class="nav-text">Phí vận chuyển</span> 
							</a>
							
						</li>
						<!-- Reviews -->
						
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-star-half"></i>
								<span class="nav-text">Đánh giá</span><b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-comment')}}">
											<span class="nav-text">Bình luận</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{URL::to('/list-review')}}">
											<span class="nav-text">Đánh giá</span>
										</a>
									</li>
								</ul>
							</div>
							
						</li>
						{{-- <li class="active">
							<a class="sidenav-item-link" >
								<i class="mdi mdi-tag-minus"></i>
								<span class="nav-text">Khuyến mãi</span>
							</a>
						</li> --}}
						<li class="has-sub active">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-tag-minus"></i>
								<span class="nav-text">Khuyến mãi</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="{{url('/add-promotion')}}">
											<span class="nav-text">Sản phẩm khuyến mãi</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="{{url('/add-promotion-accessory')}}">
											<span class="nav-text">Phụ kiện khuyến mãi</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						
                        
						
						
					</ul>
				</div>
			</div>
		</div>

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<header class="ec-main-header" id="header">
				<nav class="navbar navbar-static-top navbar-expand-lg">
					<!-- Sidebar toggle button -->
					<button id="sidebar-toggler" class="sidebar-toggle"></button>
					<!-- search form -->
					<div class="search-form d-lg-inline-block">
						
					</div>

					<!-- navbar right -->
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							<!-- User Account -->
							<li class="dropdown user-menu">
								<button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown"
									aria-expanded="false">
									<img src="{{asset('public/upload/avt_admin/icon_avt.jpg')}}" class="user-image" alt="User Image" />
								</button>
								<ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
									<!-- User image -->
									<li class="dropdown-header" style="display: flex; align-items: center;">
										<img src="{{asset('public/upload/avt_admin/icon_avt.jpg')}}" class="img-circle" alt="User Image" />
										<div class="d-inline-block">
											<?php
                                            $name = Session::get('admin_name');
                                            if ($name) {
                                                echo $name;
                                                
                                            }
                                            ?>
										</div>
									</li>
									<li>
										<a href="{{url('/account-profile/'.Session::get('admin_id'))}}">
											<i class="mdi mdi-account"></i> Thông tin cá nhân
										</a>
									</li>
									
									<li class="right-sidebar-in">
										<a href="javascript:0"> <i class="mdi mdi-settings-outline"></i> Cài đặt </a>
									</li>
									<li class="dropdown-footer">
										<a href="{{URL::to('/logout_admin')}}"> <i class="mdi mdi-logout"></i> Đăng xuất </a>
									</li>
								</ul>
							</li>
							
							<li class="right-sidebar-in right-sidebar-2-menu">
								<i class="mdi mdi-settings-outline mdi-spin"></i>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				@yield('main_admin')
			</div> <!-- End Content Wrapper -->

			<!-- Footer -->
			<footer class="footer mt-auto">
				<div class="copyright bg-white">
					<p>
						Copyright &copy; <span id="ec-year"></span><a class="text-primary"
						href="https://themeforest.net/user/ashishmaraviya" target="_blank"> vitran641@gmail.com</a>
					  </p>
				</div>
			</footer>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="{{asset('public/backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/plugins/simplebar/simplebar.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/plugins/jquery-zoom/jquery.zoom.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/plugins/slick/slick.min.js')}}"></script>

	<!-- Chart -->
	<script src="{{asset('public/backend/assets/plugins/charts/Chart.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/js/chart.js')}}"></script>

	<!-- Google map chart -->
	<script src="{{asset('public/backend/assets/plugins/charts/google-map-loader.js')}}"></script>
	<script src="{{asset('public/backend/assets/plugins/charts/google-map.js')}}"></script>

	<!-- Date Range Picker -->
	<script src="{{asset('public/backend/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{asset('public/backend/assets/js/date-range.js')}}"></script>

	<!-- Option Switcher -->
	<script src="{{asset('public/backend/assets/plugins/options-sidebar/optionswitcher.js')}}"></script>

	<!-- Ekka Custom -->
	<script src="{{asset('public/backend/assets/js/ekka.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('public/frontend/assets/js/sweetalert.js')}}"></script>
	<script src="{{asset('public/backend/assets/js/datatable.js')}}"></script>
	<script>
		$(function(e){
			$("#select_all_ids").click(function () {
				$('.checkbox_ids').prop('checked', $(this).prop('checked'));
			});

			$('#chose_all').click(function (e) {
				e.preventDefault();
				var all_ids=[];
				$('input:checkbox[name=ids]:checked').each(function(){
					all_ids.push($(this).val());
				})
				$.ajax({
					url:'{{url('/chose-promotion-accessory-product')}}',
					type:'POST',
					data:{
						ids:all_ids,
						_token:'{{csrf_token()}}'
					},
					success: function(data){
						location.reload();
						},
						
					})
				})
		});
	</script>
	<script>
		$(function(e){
			$("#select_all_ids").click(function () {
				$('.checkbox_ids').prop('checked', $(this).prop('checked'));
			});

			$('#chose_all_promotion').click(function (e) {
				e.preventDefault();
				var all_ids=[];
				$('input:checkbox[name=ids]:checked').each(function(){
					all_ids.push($(this).val());
				})
				$.ajax({
					url:'{{url('/chose-product')}}',
					type:'POST',
					data:{
						ids:all_ids,
						_token:'{{csrf_token()}}'
					},
					success: function(data){
						location.reload();
						},
						
					})
				})
		});
	</script>
	<script>
		$(function(e){
			$("#select_all_ids").click(function () {
				$('.checkbox_ids').prop('checked', $(this).prop('checked'));
			});

			$('#chose_all_accessory').click(function (e) {
				e.preventDefault();
				var all_ids=[];
				$('input:checkbox[name=ids]:checked').each(function(){
					all_ids.push($(this).val());
				})
				$.ajax({
					url:'{{url('/chose-product-accessory')}}',
					type:'POST',
					data:{
						ids:all_ids,
						_token:'{{csrf_token()}}'
					},
					success: function(data){
						location.reload();
						},
						
					})
				})
		});
	</script>
	<script>
		$(function(e){
			$("#select_all_ids").click(function () {
				$('.checkbox_ids').prop('checked', $(this).prop('checked'));
			});

			$('#chose_all_promotion_accessory').click(function (e) {
				e.preventDefault();
				var all_ids=[];
				$('input:checkbox[name=ids]:checked').each(function(){
					all_ids.push($(this).val());
				})
				$.ajax({
					url:'{{url('/chose-promotion-accessory-product')}}',
					type:'POST',
					data:{
						ids:all_ids,
						_token:'{{csrf_token()}}'
					},
					success: function(data){
						location.reload();
						},
						
					})
				})
		});
	</script>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            const brand_checkbox = document.querySelectorAll('input[name="brand_checkbox"]');
            const brand_form = document.getElementById('brand_form');
           
            brand_checkbox.forEach(option => {
                option.addEventListener('change', function() {
                    if (this.checked) {
					brand_form.hidden = false;
				} else {
					brand_form.hidden = true;
				}
                });
            });
			
        });

		document.addEventListener('DOMContentLoaded', function() {
            const productRadio = document.getElementById('product_radio');
            const accessoryRadio = document.getElementById('accessory_radio');
            const categoryDiv = document.getElementById('category_div');
           
			productRadio.addEventListener('change', function() {
                if (this.checked) {
                    categoryDiv.hidden= false;
                }
            });

            accessoryRadio.addEventListener('change', function() {
                if (this.checked) {
                    categoryDiv.hidden = true;
                }
            });

			
        });
        </script>

	<script>
		function generateSlug(value) {
        return value.toString().toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .replace(/đ/g, "d")  // Thay thế đ
            .replace(/Đ/g, "D")  // Thay thế Đ
            .replace(/\s+/g, '-') 
            .replace(/[^\w\-]+/g, '') 
            .replace(/\-\-+/g, '-') 
            .replace(/^-+/, '') 
            .replace(/-+$/, ''); 
    }
	
		document.addEventListener('DOMContentLoaded', (event) => {
			const cateInput = document.querySelector('input[name="category_product_name"]');
			const slugInput = document.querySelector('input[name="category_product_slug"]');

			cateInput.addEventListener('input', function () {
				slugInput.value = generateSlug(this.value);
			});
		
		});
		document.addEventListener('DOMContentLoaded', (event) => {
			const brandInput = document.querySelector('input[name="brand_product_name"]');
			const slugInput = document.querySelector('input[name="brand_product_slug"]');
			
			brandInput.addEventListener('input', function () {
				slugInput.value = generateSlug(this.value);
			});
		});
		document.addEventListener('DOMContentLoaded', (event) => {
			const accessoryInput = document.querySelector('input[name="accessory_name"]');
			const slugaccessory = document.querySelector('input[name="accessory_slug"]');
			
			accessoryInput.addEventListener('input', function () {
				slugaccessory.value = generateSlug(this.value);
			});
		});
		document.addEventListener('DOMContentLoaded', (event) => {
			const productInput = document.querySelector('input[name="product_name"]');
			const slugInput = document.querySelector('input[name="product_slug"]');
			
			productInput.addEventListener('input', function () {
				slugInput.value = generateSlug(this.value);
			});
		});
	</script>
	
	<Script type="text/javascript">
		$(document).ready(function(){
			$('.table_data').DataTable();
		});
	</Script>
	<Script type="text/javascript">
		$(document).ready(function(){
			fetch_delivery();
			function fetch_delivery(){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/select-shipping-fee')}}',
					method:'POST',
					data:{_token:_token},
					success:function(data){
						$('#load_delivery').html(data);						
					}
				})
			}
			
			$(document).on('blur','.edit_shipping_fee', function(){
				var feeship_id = $(this).data('shipping_fee_id');
				var fee_value = $(this).text();
				var _token = $('input[name="_token"]').val();

				fee_value = fee_value.replace(/\./g, '');
				fee_value = fee_value.slice(0, fee_value.length - 1);
			
				$.ajax({
					url: '{{url('/update-delivery')}}',
					method:'POST',
					data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
					success:function(data){
					
						alert('Sửa thành công');
						fetch_delivery();
						
						
					}
				})
			});
			$('.add_delivery').click(function(){
				var city = $('.city').val();
				var district = $('.district').val();
				var ward = $('.ward').val();
				var shipping_fee_price = $('.shipping_fee_price').val();
				var _token = $('input[name="_token"]').val();

				$.ajax({
					url: '{{url('/insert-delivery')}}',
					method:'POST',
					data:{city:city,district:district,ward:ward,shipping_fee_price:shipping_fee_price,_token:_token},
					success:function(data){
					
						alert('Thêm phí vận chuyển thành công');
						window.location.href = '{{ URL::to('/manage-delivery') }}';
						
						
					}
				})

			});
			$('.chose').on('change',(function(){
				var action = $(this).attr('id');
				var ma_id = $(this).val();
				var _token = $('input[name="_token"]').val();
				var result = '';
				
				if(action =='city'){
					result='district';
					
				}else{
					result ='ward'; 
					
				}
				$.ajax({
					url: '{{url('/select-delivery')}}',
					method:'POST',
					data:{action:action,ma_id:ma_id,_token:_token},
					success:function(data){
					
						$('#'+result).html(data);
					
					}
				})
			}));
		});
	</Script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
    </script>
    <script>
        $.validate({
            form : '#form-all', 
        });
    </script>
</body>


<!-- Mirrored from maraviyainfotech.com/projects/ekka/ekka-v37/ekka-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 11:31:50 GMT -->
</html>