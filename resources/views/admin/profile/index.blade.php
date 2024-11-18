@extends('layouts.app_theme')

@section('content')

<div class="proprofimaincov">
	<div class="profset-title">
		<h1>Profile</h1>
		<p>Welcome to Newness Profile</p>
	</div>
	<div class="userprofalldata-main">

		<div class="row">
			<div class="userprofalldata-full">
				<div class="userprofalldata-iner">

					<form method="POST" enctype="multipart/form-data" id="userform" action="javascript:void(0)">
						<div class="avatar-upload">
							<div class="avatar-preview">
								<div id="imagePreview" class="download" style="background-image: url(./images/user-icon.png);">
								</div>
							</div>
							<div class="avatar-edit form-group">
								<input type="file" name="photo" class="form-control">
								<!-- <label for="imageUpload"></label> -->
								<p>Max file size is 20mb</p>
							</div>
						</div>
						<div class="alert alert-danger" id="alert-danger-form">
						</div>
						<div class="alert alert-success" id="alert-success-form">
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="name">Name *</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="">
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="user_name">User Name *</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="email">Email Address *</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="">
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="contact">Contact *</label>
									<div class="contnumbset-cov">
										<h6>+91</h6>
										<input type="text" class="form-control" id="contact" name="contact" placeholder="" maxlength="10">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="form-group">
									<label for="password">Password *</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="">
								</div>
							</div>
							<div class="col-sm">
								<div class="form-group">
									<label for="confirm_password">Confirm Password *</label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="">
								</div>
							</div>
						</div>
						<input type="hidden" name="admin_id" id="admin_id">
						<input type="hidden" name="country_code" id="country_code">
						<div class="saveprofdata">
							<button>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@section('js')
<script type="text/javascript">
	var store = <?php echo json_encode(route('profile.store')) ?>;
	$('#alert-danger-form').hide();
	$('#alert-success-form').hide();
	$('#alert-success-list').hide();
	$('#alert-danger-list').hide();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})

	$("#userform").validate({
		ignore: [],
		rules: {
			"name": {
				required: true,
				minlength: 1,
				maxlength: 100,
				pattern: '^[a-zA-Z ]+$'
			},
			"username": {
				required: true,
			},
			"email": {
				required: true,
				email: true
			},
			"contact": {
				required: true,
				digits: true,
				minlength: 10,
			},
			"password": {
				required: function(element) {
					return $('#admin_id').val() == '';
				},
				minlength: 8,
				pattern: '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%&*])[a-zA-Z0-9!@#$%&*]+$'
			},
			"confirm_password": {
				required: function(element) {
					return $('#admin_id').val() == '';
				},
				equalTo: "#password"
			},
			"photo": {
                extension: "jpg|jpeg|png"
            },
		},
		messages: {
			"name": {
				pattern: "name should be only alphabet characters"
			},
			"email": {
				required: "Please, enter a email"
			},
			"password": {
				pattern: "Password should contain one uppercase, one lowercase, one special characters, and one numeric value"
			},
			"photo": {
                extension: "Allow file type is jpeg, png, jpg"
            },
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "gender")
				error.insertAfter(".gender-custom-error");
			else
				error.insertAfter(element);
		},
		submitHandler: function() {
			var formData = new FormData(document.getElementById("userform"));
			$.ajax({
				type: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.success) {
						$('#alert-danger-form').hide();
						$('#alert-success-form').show();
						$('#alert-success-form').text(data.message);
						setTimeout(function() {
							window.location.reload()
						}, 3000);
					} else if (data.message == 'Error validation') {
						$('#alert-success-form').hide();
						$('#alert-danger-form').show();
						for (var key in data.data) {
							var value = data.data[key];
							$('#alert-danger-form').text(value[0]);
						}
					} else {
						$('#alert-success-form').hide();
						$('#alert-danger-form').show();
						$('#alert-danger-form').text(data.message);
					}
				},
				error: function(data) {
					console.log('Error:', data);
					$('#saveBtn').html('Save');
				}
			});
			return false;
		}
	});

	var admin_id = '<?php echo $user_id ?>';
	var base_url = '<?php echo url('/'); ?>';
	$.get("{{ url('admin/'.$urlSlug.'/') }}" + '/' + admin_id + '/edit', function(data) {
		$('#admin_id').val(data.data.id);
		$('#name').val(data.data.name);
		$('#username').val(data.data.username);
		$('#email').val(data.data.email);
		$('#contact').val(data.data.phone);
		$('#country_code').val(data.data.country_code);
		if (data.data.photo) {
			$('.download').css('background-image', 'url(' + base_url + '/public/' + data.data.photo + ')')
		} else {
			// default image profile
			$('.download').css('background-image', 'url(' + base_url + '/public/images/user-icon.png)')
		}
	})
</script>
<script>
		 var input = document.querySelector("#contact");
		 window.intlTelInput(input, {
			separateDialCode: true,
			customPlaceholder: function (
				selectedCountryPlaceholder,
				selectedCountryData
			) {
				return "e.g. " + selectedCountryPlaceholder;
			},
		});
	
		var iti = window.intlTelInputGlobals.getInstance(input);
		setTimeout(function () {
			iti.setCountry($('#country_code').val());
         }, 3000);
		input.addEventListener('blur', function() { 
			var countryCode = iti.getSelectedCountryData().iso2;
			$('#country_code').val(countryCode);
		});
	</script>
	@endsection
@endsection