@extends('layouts.app_theme')

@section('content')
<div class="coveradminalldata">
	<div class="main-contsleftright">
		<div class="leftdatamain_cover">
			<div class="profset-title">
				<h1>Profile</h1>
				<p>Welcome to Gord Academy Profile</p>
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
											<label for="name">First Name *</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="">
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="lastname">Last Name *</label>
											<input type="text" class="form-control" id="lastname" name="lastname" placeholder="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="education">Education</label>
											<input type="text" class="form-control" id="education" name="education" placeholder="">
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="language">Language</label>
											<input type="text" class="form-control" id="language" name="language" placeholder="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="gender">Gender</label>
											<select name="gender" id="gender" class="form-control">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="price">DOB</label>
											<input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="availability">Availibility</label>
											<input type="text" class="form-control" id="availability" name="availability" placeholder="">
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="contact">Contact *</label>
											<div class="contnumbset-cov">
												<h6>+91</h6>
												<input type="text" class="form-control" id="contact" name="contact" maxlength="10" placeholder="">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="experience">Years Of Experience</label>
											<input type="text" class="form-control" id="experience" name="experience" placeholder="">
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="designation">Designation</label>
											<input type="text" class="form-control" id="designation" name="designation" placeholder="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="present_address">Present address</label>
											<textarea name="present_address" id="present_address" class="form-control"></textarea>
										</div>
									</div>
									<div class="col-sm">
										<div class="form-group">
											<label for="permanant_address">Permanant Address</label>
											<textarea name="permanant_address" id="permanant_address" class="form-control"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<div class="form-group">
											<label for="aboutme">About me</label>
											<textarea name="aboutme" id="aboutme" class="form-control"></textarea>
										</div>
									</div>
								</div>
								<input type="hidden" name="teacher_id" id="teacher_id">
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
		@include('teacher.right_sidebar')
	</div>
</div>
@section('js')
	<script>
		$(document).ready(function() {
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd',
				todayHighlight: true,
			});
		});
	</script>
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
					maxlength: 20,
					pattern: '^[a-zA-Z ]+$'
				},
				"lastname": {
					required: true,
					minlength: 1,
					maxlength: 20,
					pattern: '^[a-zA-Z ]+$'
				},
				"contact": {
					required: true,
					digits: true,
					minlength: 10,
				},
				"experience": {
					number: true
				},
				"photo": {
					extension: "jpg|jpeg|png"
				},
			},
			messages: {
				"photo": {
					extension: "Allow file type is jpeg, png, jpg"
				},
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

		var teacher_id = '<?php echo $user_id ?>';
		var base_url = '<?php echo url('/'); ?>';
		$.get("{{ url('teacher/'.$urlSlug.'/') }}" + '/' + teacher_id + '/edit', function(data) {
			$('#teacher_id').val(data.data.id);
			$('#name').val(data.data.name);
			$('#lastname').val(data.data.lastname);
			$('#education').val(data.data.education);
			$('#dob').val(data.data.dob);
			$("#dob").datepicker("setDate", data.data.dob);
			$('#availability').val(data.data.availability);
			$('#contact').val(data.data.phone);
			$('#experience').val(data.data.years_experience);
			$('#designation').val(data.data.designation);
			$('#present_address').val(data.data.present_address);
			$('#permanant_address').val(data.data.permananat_address);
			$('#aboutme').val(data.data.aboutme);
			$('#gender').val(data.data.gender);
			$('#language').val(data.data.language);
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
