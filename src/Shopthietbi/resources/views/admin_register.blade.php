<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from maraviyainfotech.com/projects/ekka/ekka-v37/ekka-admin/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 11:33:55 GMT -->
<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

		<title>Ekka - Admin Dashboard HTML Template.</title>
		
		<!-- GOOGLE FONTS -->
		<link rel="preconnect" href="https://fonts.googleapis.com/">
		<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet">

		<link href="{{asset('public/backend/assets/css/materialdesignicons.min.css')}}" rel="stylesheet" />
		
		<link href="{{asset('public/backend/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
	<link href="{{asset('public/backend/assets/plugins/simplebar/simplebar.css')}}" rel="stylesheet" />

	<!-- Ekka CSS -->
	<link id="ekka-css" href="{{asset('public/backend/assets/css/ekka.css')}}" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="{{asset('public/backend/assets/img/favicon.png')}}')}}" rel="shortcut icon" />
	</head>
	
	<body class="sign-inup" id="body">
		<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
			<div class="row justify-content-center" style="width: 100%;">
				<div class="col-lg-6 col-md-10">
					<div class="card">
						<div class="card-header bg-primary">
							<div class="ec-brand">
								<a href="index.html" title="Ekka">
									<img class="ec-brand-icon" src="{{asset('public/backend/assets/img/logo/logo-login.png')}}" alt="" />
								</a>
							</div>
						</div>
				  <div class="card-body p-5">
					<h4 class="text-dark mb-5">Đăng ký</h4>
		
					<form action="{{URL::to('/save-admin')}}" method="post">
						{{ csrf_field() }}
					  <div class="row">
						<div class="form-group col-md-12 mb-4">
						  <input type="text" class="form-control" name="admin_name" id="name" placeholder="Name">
						</div>
		
						<div class="form-group col-md-12 mb-4">
						  <input type="email" class="form-control" name="admin_email" id="email" placeholder="Email">
						</div>
		
						<div class="form-group col-md-12 ">
						  <input type="password" class="form-control" name="admin_password" id="password" placeholder="Password">
						</div>
						<div class="form-group col-md-12 ">
							<input type="text" class="form-control" name="admin_phone" id="phone" placeholder="Phone">
						  </div>
						
	
						<div class="col-md-12">
						  
						  <button type="submit" class="btn btn-primary btn-block mb-4">Đăng ký</button>
		
						  <p class="sign-upp">Already have an account?
							<a class="text-blue" href="{{URL::to('/login-admin')}}">Đăng nhập</a>
						  </p>
						</div>
					  </div>
					</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
		<!-- Javascript -->
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
	</body>

<!-- Mirrored from maraviyainfotech.com/projects/ekka/ekka-v37/ekka-admin/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 11:33:55 GMT -->
</html>