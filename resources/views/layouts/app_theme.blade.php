<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/progress-bar.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">

	<script src="{{ asset('public/js/jquery-3.6.0.min.js') }}"></script>

	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" href="{{ asset('public/css/additional/jquery-ui.css') }}">

	<link rel="stylesheet" href="{{ asset('public/css/additional/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/additional/responsive.dataTables.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">

	<link rel="stylesheet" href="{{ asset('public/css/additional/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/additional/fullcalendar.print.css') }}" media='print' />

	<link rel="stylesheet" href="{{ asset('public/css/additional/intlTelInput.css') }}"/>

	<script src="{{ asset('public/js/additional/jquery.validate.js') }}"></script>
	<script src="{{ asset('public/js/additional/additional-methods.js') }}"></script>

	<!-- common in both front and back -->
	<link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}" />
	<script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>
</head>

<body>

	@include('common.admin.sidebar')
	<section class="home-section mainhomeallnav-cover">
		@include('common.admin.navigation')
		<div class="coveradminalldata">
			@yield('content')
		</div>
	</section>


	<script src="{{ asset('public/js/popper.min.js') }}"></script>
	<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/js/custom.js') }}"></script>
	<script src="{{ asset('public/js/bootstrap-datepicker.min.js') }}"></script>
	<!-- <script src="{{ asset('public/js/additional/jquery-ui.js') }}"></script> -->

	<script src="{{ asset('public/js/additional/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/js/additional/dataTables.responsive.js') }}"></script>

	<!-- used for export-->
	<script src="{{ asset('public/js/additional/datatables.min.js') }}"></script>

	<!-- used for calendar -->
	<script src="{{ asset('public/js/additional/moment.min.js') }}"></script>
	<script src="{{ asset('public/js/additional/fullcalendar.min.js') }}"></script>

	<script src="{{ asset('public/js/additional/intlTelInput.js') }}"></script>
	<script src="{{ asset('public/js/additional/utils.js') }}"></script>
	<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>

	<script>
		let sidebar = document.querySelector(".sidebar");
		let sidebarBtn = document.querySelector(".sidebarBtn");
		sidebarBtn.onclick = function() {
			sidebar.classList.toggle("active");
			if (sidebar.classList.contains("active")) {
				sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
			} else
				sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
		}

		$('.js-example-basic-single').select2({
			width: "95%",
			dropdownParent: $('#ajaxModel')
		})
	</script>
	@yield('js')
</body>

</html>