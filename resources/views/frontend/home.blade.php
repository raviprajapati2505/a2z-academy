@extends('layouts.app_front')

@section('content')
<!-- <div id="meetingSDKElement">
	Zoom Meeting SDK Rendered Here
</div> -->
<div class="bgmainheader-cover">
	<div class="getstart-leftrightcov">
		<div class="container">
			<div class="getstartmain-left">
				<h3>Get Started</h3>
				<h5>Your <span>Learning</span> & <br> Enrich your <span>Dream</span></h5>
				<div class="srcmainda-listcov">
					<div class="srcmainda-left">
						<select class="form-select course-name" aria-label="Default select example">
							<option selected>Select New Course</option>
							@foreach($all_courses as $course)
							<option value="1">{{ $course->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="srcmainda-mid">
						<select class="form-select class-name" aria-label="Default select example">
							<option selected>Class</option>
							@foreach($class_list as $class)
							<option value="{{ $class->id }}">{{$class->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="srcmainda-right">
						<a href="javascript:void(0);" class="enroll-home">Enroll Now</a>
					</div>
				</div>
			</div>
			<div class="getstartmain-right">
				<img src="{{ asset('public/frontend/images/images-banner-1.png') }}" alt="">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="onvioustmain-cover">
		<div class="onvioustmain-iner">
			<div class="onvioustiner-leftrig">
				<div class="onvioustiner-lef">
					<img src="{{ asset('public/frontend/images/icon-1.png') }}" alt="Icon">
				</div>
				<div class="onvioustiner-rig">
					<h3>{{ count($all_courses) }}+</h3>
					<p>Online Courses</p>
				</div>
			</div>
		</div>
		<div class="onvioustmain-iner">
			<div class="onvioustiner-leftrig">
				<div class="onvioustiner-lef">
					<img src="{{ asset('public/frontend/svg/icon-2.svg') }}" alt="Icon">
				</div>
				<div class="onvioustiner-rig">
					<h3>{{ $video_tutorials_count }}+</h3>
					<p>Video Tutorials</p>
				</div>
			</div>
		</div>
		<div class="onvioustmain-iner">
			<div class="onvioustiner-leftrig">
				<div class="onvioustiner-lef">
					<img src="{{ asset('public/frontend/svg/icon-3.svg') }}" alt="Icon">
				</div>
				<div class="onvioustiner-rig">
					<h3>{{ $adviser_count }}+</h3>
					<p>Our Advisors</p>
				</div>
			</div>
		</div>
		<div class="onvioustmain-iner">
			<div class="onvioustiner-leftrig">
				<div class="onvioustiner-lef">
					<img src="{{ asset('public/frontend/svg/icon-4.svg') }}" alt="Icon">
				</div>
				<div class="onvioustiner-rig">
					<h3>{{ $all_review_count }}+</h3>
					<p>Trainee Reviews</p>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- <div class="iframe-container" style="overflow: hidden; padding-top: 56.25%; position: relative;"> <iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="https://zoom.us/wc/join/86473712696" frameborder="0"></iframe> </div> -->

<div class="container">
	<div class="letjourneymain-cover">
		<div class="letjourneymain-title">
			<h3>Let the journey of <br>
				<span style="color: #f21b68;">Self-learning</span> <span style="color: #221c71;">Begin</span>
			</h3>
			<p>Go to the section of your choice to study any topic on any subject</p>
		</div>
		<div class="grcoscco-maincov">
			<div class="grcosccomain-box grcoscco-color1">
				<a href="javascript:void(0);">
					<div class="grcoscco-maininer">
						<div class="grcoscco-left">
							<img src="{{ asset('public/frontend/svg/journey-icon-1.svg') }}" alt="">
						</div>
						<div class="grcoscco-right">
							<p>Grade</p>
						</div>
					</div>
				</a>
			</div>
			<div class="grcosccomain-box grcoscco-color2">
				<a href="javascript:void(0);">
					<div class="grcoscco-maininer">
						<div class="grcoscco-left">
							<img src="{{ asset('public/frontend/svg/journey-icon-2.svg') }}" alt="">
						</div>
						<div class="grcoscco-right">
							<p>Commerce</p>
						</div>
					</div>
				</a>
			</div>
			<div class="grcosccomain-box grcoscco-color3">
				<a href="javascript:void(0);">
					<div class="grcoscco-maininer">
						<div class="grcoscco-left">
							<img src="{{ asset('public/frontend/svg/journey-icon-3.svg') }}" alt="">
						</div>
						<div class="grcoscco-right">
							<p>Science</p>
						</div>
					</div>
				</a>
			</div>
			<div class="grcosccomain-box grcoscco-color4">
				<a href="javascript:void(0);">
					<div class="grcoscco-maininer">
						<div class="grcoscco-left">
							<img src="{{ asset('public/frontend/svg/journey-icon-4.svg') }}" alt="">
						</div>
						<div class="grcoscco-right">
							<p>Competitive
								Exams</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="grcosccomain-viewall">
			<a href="javascript:void(0);">View All</a>
		</div>
	</div>
</div>

<div class="popucours-cover">
	<div class="container">
		<div class="popucours-title">
			<div class="popucourtitle-left">
				<p>Our Most</p>
				<h3>Popular Course</h3>
			</div>
			<div class="popucourtitle-right">
				<a href="{{ url('/course_by_type/all')}}">All Course</a>
			</div>
		</div>

		<div class="popucours-sldbox">
			<div class="row">
				<div class="owl-carousel owl-theme owlnavslider-nav" id="ourmostslider">
					@if(count($all_courses) > 0)
					@foreach($all_courses as $course)
					<div class="item">
						<div class="coursesdata-cover">
							<div class="coursesdata-iner">
								<div class="coursesdata-img">
									<div class="retclass">
										<?php
										$total_start_rating = 0;
										foreach ($course->student_review as $rating) {
											$total_start_rating += $rating->star_rating;
										}
										?>
										<?php
										if (count($course->student_review) == 0) {
											$avg_rating = '1';
										} else {
											$avg_rating = $total_start_rating / count($course->student_review);
										}
										?>
										<h5>{{ round($avg_rating) }} <i class="bx bxs-star"></i></h5>
									</div>
									@if($course->cover_image)
									<a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
									@else
									<!-- default image course -->
									<a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
									@endif
								</div>
								<div class="coursesdata-text">
									<h3>{{ $course->name }}</h3>
									<p>{{ $course->description }}</p>
									<div class="popucours-sldin">
										<h5>
											<?php
											$total_free_videos = 0;
											foreach ($course->curriculam_lecture as $lecture) {
												if ($lecture->is_free == 0) {
													$total_free_videos += 1;
												}
											}
											if ($course->is_paid == 0) {
												echo 'Free Course';
											} else {
												echo '(' . $total_free_videos . ' Free Videos)';
											}
											?>
										</h5>
										<?php if ($course->is_paid == 1) { ?>
											<a href="<?= url('/manage_payment') . '/' . $course->id ?>">Enroll Now</a>
										<?php } else { ?>
											<a href="<?= url('/course_detail') . '/' . $course->id ?>">View Course</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<p>No courses available</p>
					@endif
				</div>
			</div>
		</div>

	</div>
</div>

<div class="dowmobiapp-min">
	<div class="container">
		<div class="dowmobiapp-mcover">
			<div class="dowmobiapp-left">
				<h2>Download our mobile app, start <br>
					<span>learning today</span>
				</h2>
				<div class="dowmobiapp-vilicocov">
					<div class="dowmobiapvilico-lef">
						<img src="{{ asset('public/frontend/svg/learning-today-icon-1.svg') }}" alt="">
					</div>
					<div class="dowmobiapvilico-rig">
						<h4>Video lectures</h4>
						<p>Learn as you wish, get more than 20,000 video lectures</p>
					</div>
				</div>
				<div class="dowmobiapp-vilicocov">
					<div class="dowmobiapvilico-lef">
						<img src="{{ asset('public/frontend/svg/learning-today-icon-2.svg') }}" alt="">
					</div>
					<div class="dowmobiapvilico-rig">
						<h4>Live class</h4>
						<p>Take part in daily live classes and keep up the routine reading</p>
					</div>
				</div>
				<div class="dowmobiapp-vilicocov">
					<div class="dowmobiapvilico-lef">
						<img src="{{ asset('public/frontend/svg/learning-today-icon-3.svg') }}" alt="">
					</div>
					<div class="dowmobiapvilico-rig">
						<h4>Convenient practice</h4>
						<p>Practice at a convenient time, check your score right now</p>
					</div>
				</div>

			</div>
			<div class="dowmobiapp-right">
				<img src="{{ asset('public/frontend/images/mobile-image-1.png') }}" alt="">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="myclsstudy-maincov">
		<div class="myclsstudy-maintitle">
			<p>My Class</p>
			<h3>What stage of study are you now?</h3>
		</div>
		<div class="myclsstudy-slider">
			<div class="row">
				<div class="owl-carousel owl-theme owlnavslider-nav" id="myclassslider">
					@if(count($newness_classes) > 0)
					@foreach($newness_classes as $class)
					<div class="item">
						<div class="coursesdata-cover">
							<div class="coursesdata-iner">
								<div class="coursesdata-img">
									<div class="retclass">
										<h5>3.5 <i class="bx bxs-star"></i></h5>
									</div>
									@if($class->newness_class->image)
									<img src="<?= url('/') . '/public/' . $class->newness_class->image ?>">
									@else
									<!-- default image class -->
									<img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
									@endif
								</div>
								<div class="coursesdata-text">
									<div class="livtexttitle-cov">
										<h3>{{ $class->newness_class->title }} <span>(Live Class)</span></h3>
										<h6><i class="bx bx-time-five"></i> 2 hr</h6>
									</div>
									<p>{{ $class->newness_class->description }}</p>
									<div class="popucours-sldin">
										<h5>(460 Free Videos)</h5>
										<a href="javascript:void(0);">Enroll Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<p>No classes available</p>
					@endif
				</div>
				<div class="allcoursebtnmain-cover">
					<a href="{{ url('/course_by_type/all')}}">All Course</a>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="feedbackmain-slider">
	<div class="container">
		<div class="feedbackmain-cover">
			<div class="feedbackmain-left">
				<img src="{{ asset('public/frontend/images/quotes-icon-2.png') }}" alt="">
				<h6>Trainees feedback</h6>
				<h3>Our Trainees Says</h3>
				<p>Lorem ipsum dolor sit amet, consectetur
					adipisicing elit. Accusantium
					officia cupiditate.</p>
				<a href="javascript:void(0);">Join Now</a>
			</div>
			<div class="feedbackmain-right">
				<div class="owl-carousel owl-theme" id="feedbackslider">
					@if(count($student_review) > 0)
					@foreach($student_review as $review)
					<div class="item">
						<div class="feedbackmain-iner">
							<img src="{{ asset('public/frontend/images/quotes-icon-1.png') }}" alt="" class="usericon-top">
							<p>{{ $review->feedback_text }}</p>
							<div class="feedbackmain-usrimtxt">
								@if($review->student->photo)
								<img src="<?= url('/') . '/public/' ?>{{ $review->student->photo }}">
								@else
								<!-- default image profile -->
								<img src="{{ asset('public/images/user-icon.png') }}" alt="Allie Grater">
								@endif
								<h3>{{ $review->student->name }}</h3>
								<h6>Trainee </h6>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="skilldeve-maincov">
		<div class="myclsstudy-maintitle">
			<p>Skill Development Courses</p>
			<h3>What stage of study are you now?</h3>
		</div>
		<div class="skilllist-cover">
			<ul class="owl-filter-bar">
				@if(count($course_types) > 0)
				@foreach($course_types as $type)
				<li class="btn-filter" id="{{ $type->id }}"><a data-owl-filter="{{ $type->id }}" class="item" href="javascript:void(0);">{{ $type->title }}</a></li>
				@endforeach
				@endif
			</ul>
		</div>
		<div class="skilldevecou-sld">
			<div class="row">
				<div class="owl-carousel owl-theme" id="skilldevesld">
					@if(count($all_courses) > 0)
					@foreach($all_courses as $course)
					<div class="item {{ $course->course_type_id }}">
						<div class="coursesdata-cover">
							<div class="coursesdata-iner">
								<div class="coursesdata-img">
									@if($course->cover_image)
									<a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
									@else
									<!-- default image course -->
									<a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
									@endif
								</div>
								<div class="skildevecovmain-text">
									<h3>{{ $course->name }}</h3>
									<a href="{{ url('course_detail') }}<?= '/' . $course->id ?>">See More</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<p>No courses available</p>
					@endif

				</div>
				<div class="allcoursebtnmaincov1">
					<a href="{{ url('/course_by_type/all')}}">All Course</a>
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var owl = $("#skilldevesld").owlCarousel({
			margin: 10,
			loop: false,
			nav: true,
			items: 3,
			responsive: {
				0: {
					items: 1,
				},
				390: {
					items: 1,
				},
				420: {
					items: 1,
				},
				550: {
					items: 2
				},
				768: {
					items: 3
				}
			}
		});

		var $btns = $('.btn-filter').click(function() {
			if (this.id == 'all') {
				$('#skilldevesld .item').fadeIn(450);
			} else {
				var $el = $('.' + this.id).fadeIn(450);
				$('#skilldevesld .item').not($el).hide();
			}
			$btns.removeClass('active');
			$(this).addClass('active');
		})

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		$('.class-name').click(function() {
			var store = <?php echo json_encode(route('filter_course_by_class')) ?>;
			$.ajax({
				data: {
					class_id: $('.class-name').val()
				},
				url: store,
				type: "POST",
				dataType: 'json',
				success: function(data) {
					if (data.success && data.data.length > 0) {
						$('.course-name')
							.find('option')
							.remove()
						$('.course-name')
							.append($("<option></option>")
								.attr("value", '')
								.text('Select New Course'));
						$.each(data.data, function(key, value) {
							$('.course-name')
								.append($("<option></option>")
									.attr("value", value.id)
									.text(value.name));
						});
					}
				},
				error: function(data) {
					console.log('Error:', data);
					$('#saveBtn').html('Save');
				}
			});
		});

		$('.enroll-home').click(function() {
			var course_id = $('.course-name').val()
			if (course_id) {
				var base_url = '<?php echo url('/'); ?>';
				window.location.href = base_url + '/course_detail/' + course_id
			}
		})
	})
</script>
@endsection
