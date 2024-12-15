@extends('layouts.app_front')

@section('content')
<!-- <div id="meetingSDKElement">
	Zoom Meeting SDK Rendered Here
</div> -->
<style>
    .hide {
        display: none;
    }
</style>
<div class="bgmainheader-cover">
    <div class="getstart-leftrightcov">
        <div class="container">
            <div class="getstartmain-left">
                <h3>Elevate Your</h3>
                <h5><span>Career</span> for a <br> Sustainable <span>Tomorrow</span></h5>
                <div class="srcmainda-listcov">
                    <div class="srcmainda-mid">
                        <select class="form-select category_id" aria-label="Default select example">
                            <option selected>Category</option>
                            @foreach($course_types as $ctype)
                            <option value="{{ $ctype->id }}">{{$ctype->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="srcmainda-left">
                        <select class="form-select course-name" aria-label="Default select example">
                            <option selected>Select Course</option>
                            @foreach($all_courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                    <!-- <h3>{{ count($all_courses) }}+</h3> -->
                    <h3>75+</h3>
                    <p>Online Courses</p>
                </div>
            </div>
        </div>
        <div class="onvioustmain-iner">
            <div class="onvioustiner-leftrig">
                <div class="onvioustiner-lef">
                    <img src="{{ asset('public/frontend/images/icon-2.png') }}" alt="Icon">
                </div>
                <div class="onvioustiner-rig">
                    <!-- <h3>{{ $video_tutorials_count }}+</h3> -->
                    <h3>24+</h3>
                    <p>Video Tutorials</p>
                </div>
            </div>
        </div>
        <div class="onvioustmain-iner">
            <div class="onvioustiner-leftrig">
                <div class="onvioustiner-lef">
                    <img src="{{ asset('public/frontend/images/icon-3.png') }}" alt="Icon">
                </div>
                <div class="onvioustiner-rig">
                    <!-- <h3>{{ $adviser_count }}+</h3> -->
                    <h3>17+</h3>
                    <p>Our Advisors</p>
                </div>
            </div>
        </div>
        <div class="onvioustmain-iner">
            <div class="onvioustiner-leftrig">
                <div class="onvioustiner-lef">
                    <img src="{{ asset('public/frontend/images/icon-4.png') }}" alt="Icon">
                </div>
                <div class="onvioustiner-rig">
                    <!-- <h3>{{ $all_review_count }}+</h3> -->
                    <h3>5000+</h3>
                    <p>Learner Reviews</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- <div class="iframe-container" style="overflow: hidden; padding-top: 56.25%; position: relative;"> <iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="https://zoom.us/wc/join/86473712696" frameborder="0"></iframe> </div> -->

<!-- <div class="container">
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
</div> -->

<div class="container">
    <div class="myclsstudy-maincov">
        <div class="myclsstudy-maintitle">
            <p>News</p>
            <h3>Highlights & Updates</h3>
        </div>
        <div class="myclsstudy-slider">
            <div class="row">
                <div class="owl-carousel owl-theme owlnavslider-nav" id="myclassslider">
                    @if(count($news) > 0)
                    @foreach($news as $newsdata)
                    <div class="item">
                        <div class="coursesdata-cover">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <!-- <div class="retclass">
                                        <h5>3.5 <i class="bx bxs-star"></i></h5>
                                    </div> -->
                                    @if($newsdata->image)
                                    <img src="<?= url('/') . '/public/' . $newsdata->image ?>">
                                    @else
                                    <!-- default image class -->
                                    <img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater">
                                    @endif
                                </div>
                                <div class="coursesdata-text">
                                    <div class="livtexttitle-cov">
                                        <h3>{{ $newsdata->title }}</h3>
                                        <!-- <h6><i class="bx bx-time-five"></i> 2 hr</h6> -->
                                    </div>
                                    @php
                                    $maxLines = 10;
                                    $lineLength = 100; // Average number of characters per line
                                    $maxChars = $maxLines * $lineLength;

                                    $truncatedText = strlen($newsdata->description) > $maxChars
                                    ? substr($newsdata->description, 0, $maxChars) . '...'
                                    : $newsdata->description;
                                    @endphp
                                    <p class="read-more" data-full-text="{{ $newsdata->description }}">{{ $truncatedText }}</p>
                                    <a href="https://www.gord.qa/category/news/" class="toggle-text-btn">Read More</a>
                                    <!-- <div class="popucours-sldin">
                                        <h5>(460 Free Videos)</h5>
                                        <a href="javascript:void(0);">Enroll Now</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No news available</p>
                    @endif
                </div>
                <!-- <div class="allcoursebtnmain-cover">
                    <a href="{{ url('/course_by_type/all')}}">All Course</a>
                </div> -->
            </div>

        </div>
    </div>
</div>

<div class="popucours-cover">
    <div class="container">
        <div class="popucours-title">
            <div class="popucourtitle-left">
                <p>Our Most</p>
                <h3>Recent Course</h3>
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
                                    <div class="retclassgif">
                                        @if(\Carbon\Carbon::parse($course->created_at)->diffInDays(\Carbon\Carbon::now()) <= 20)
                                            <img style="height:20px;width:40px !important" src="{{ asset('public/frontend/images/new.png') }}">
                                            @endif
                                    </div>
                                    @if(!empty($course->date) && isset($course->date))
                                    <div class="retclassdate">
                                        <h5>{{ date('F d, Y', strtotime($course->date)) }}</h5>
                                    </div>
                                    @endif
                                    @if($course->cover_image)
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
                                    @else
                                    <!-- default image course -->
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
                                    @endif
                                </div>
                                <div class="coursesdata-text">
                                    <h3>{{ $course->name }}</h3>
                                    @php
                                    $maxLines = 1;
                                    $lineLength = 50; // Average number of characters per line
                                    $maxChars = $maxLines * $lineLength;

                                    $truncatedText = strlen($course->description) > $maxChars
                                    ? substr($course->description, 0, $maxChars) . '...'
                                    : $course->description;
                                    @endphp
                                    <p>{{ $truncatedText }}</p>
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>" class="toggle-text-btn">Read More</a>
                                    <div class="popucours-sldin">
                                        <!-- <h5>
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
                                        </h5> -->
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
<?php /*
<div class="container">
    <div class="myclsstudy-maincov">
        <div class="myclsstudy-maintitle">
            <p>Batch</p>
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
*/ ?>

<div class="feedbackmain-slider">
    <div class="container">
        <div class="feedbackmain-cover">
            <div class="feedbackmain-left">
                <img src="{{ asset('public/frontend/images/quotes-icon-2.png') }}" alt="">
                <h6>Trainees feedback</h6>
                <h3>What Our Trainees Have to Say</h3>
                <p>Discover how our training programs have equipped professionals with the skills to excel in their careers and contribute to a more sustainable future.</p>
                <a href="<?= url('/login') ?>">Join Now</a>
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
                                <h6>Learner </h6>
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
            <p>Diverse Range of Courses</p>
            <h3>Empowering professionals for a climate-resilient future</h3>
        </div>
        <div class="skilllist-cover">
            <ul class="owl-filter-bar">
                <li class="btn-filter" id="project-terms"><a id="all" class="active" href="javascript:void(0);">ALL</a></li>
                @if(count($course_types) > 0)
                @foreach($course_types as $type)
                <li class="btn-filter" id="project-terms"><a id="{{ $type->id }}" class="item" href="javascript:void(0);">{{ $type->title }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="skilldevecou-sld">
            <div class="row">
                <div class="owl-carousel owl-theme" id="owl-demo">
                    @if(count($all_courses) > 0)
                    @foreach($all_courses as $course)
                    <div class="project {{ $course->course_type_id }}">
                        <div class="coursesdata-cover">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    @if(!empty($course->date) && isset($course->date))
                                    <div class="retclassdate">
                                        <h5>{{ date('F d, Y', strtotime($course->date)) }}</h5>
                                    </div>
                                    @endif
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
                <div id="projects-copy" class="hide"></div>
                <div class="allcoursebtnmaincov1">
                    <a href="{{ url('/course_by_type/all')}}">All Course</a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="myclsstudy-maincov">
        <div class="myclsstudy-maintitle">
            <!-- <p>P</p> -->
            <h3>TRUSTED BY</h3>
        </div>
        <div class="myclsstudy-slider">
            <div class="row">
                <div class="owl-carousel owl-theme owlnavslider-nav" id="stackholderslider">
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client11.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client9.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client8.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client7.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client6.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client4.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client2.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client10.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client5.jpg') }}">
                    </div>
                    <div class="item">
                        <img style="width:200px" src="{{ asset('public/frontend/images/clients/client3.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dowmobiapp-min">
    <div class="container">
        <div class="dowmobiapp-mcover">
            <div class="dowmobiapp-left">
                <h2>Why GORD Academy? <br>
                    <!-- <span>on Any Device!</span> -->
                </h2>

                <p style="text-align:justify;color:white">For entities across the globe, sustainability is fast becoming a strategic imperative. The global construction industry is shifting towards green building practices, energy giants are transitioning to renewables, hospitality sector is exploring ways to be in sync with rapidly growing green tourism… sustainability is increasingly gaining traction across the global socioeconomic spectrum.</p>
                <p style="text-align:justify;color:white"> With global warming on the rise, the fight against climate change has led to a remarkable momentum for materializing Paris Agreement to limit the earth’s temperature below 2oC. Governments, businesses and societies at large are all looking for trusted avenues that provide high-quality capacity building programs targeting multiple dimensions of climate and environment tailored to meet the specific needs of different industries.</p>
                <!-- <div class="dowmobiapp-vilicocov">
                    <div class="dowmobiapvilico-lef">
                        <img src="{{ asset('public/frontend/images/icon-01.png') }}" alt="">
                    </div>
                    <div class="dowmobiapvilico-rig">
                        <h4>Video lectures</h4>
                        <p>Learn as you wish, get more than 20,000 video lectures</p>
                    </div>
                </div>
                <div class="dowmobiapp-vilicocov">
                    <div class="dowmobiapvilico-lef">
                        <img src="{{ asset('public/frontend/images/icon-01.png') }}" alt="">
                    </div>
                    <div class="dowmobiapvilico-rig">
                        <h4>Live class</h4>
                        <p>Take part in daily live classes and keep up the routine reading</p>
                    </div>
                </div>
                <div class="dowmobiapp-vilicocov">
                    <div class="dowmobiapvilico-lef">
                        <img src="{{ asset('public/frontend/images/icon-03.png') }}" alt="">
                    </div>
                    <div class="dowmobiapvilico-rig">
                        <h4>Convenient practice</h4>
                        <p>Practice at a convenient time, check your score right now</p>
                    </div>
                </div> -->

            </div>
            <div class="dowmobiapp-right">
                <img src="{{ asset('public/frontend/images/home-about-img3.jpg') }}" alt="">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            navigation: true,
            pagination: true
        };
        $("#owl-demo").owlCarousel(options);

        function showProjectsbyCat(cat) {
            var owl = $("#owl-demo").data('owl.carousel');

            var nb = owl.items().length;
            console.log(nb)
            for (var i = 0; i < (nb - 1); i++) {
                owl.remove(i);
            }
            console.log(cat);
            if (cat == 'all') {
                $('#projects-copy .project').each(function() {
                    owl.add($(this).clone());
                    owl.refresh();
                });
            } else {
                $('#projects-copy .project.' + cat).each(function() {
                    console.log($(this).clone());
                    owl.add($(this).clone());
                    owl.refresh();
                });
            }
        }
        $('#owl-demo .project').clone().appendTo($('#projects-copy'));
        $('#project-terms a').click(function(e) {
            e.preventDefault();
            $('#project-terms a').removeClass('active');

            cat = $(this).attr('ID');
            $(this).addClass('active');
            showProjectsbyCat(cat);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('.category_id').click(function() {
            var store = <?php echo json_encode(route('filter_course_by_class')) ?>;
            $.ajax({
                data: {
                    category_id: $('.category_id').val()
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
    $(".toggle-text-btn").on("click", function() {
        const $description = $(this).prev(".read-more");
        const fullText = $description.data("full-text");
        const isExpanded = $(this).text() === "Read Less";

        if (isExpanded) {
            $description.text(fullText.slice(0, 1000) + "...");
            $(this).text("Read More");
        } else {
            $description.text(fullText);
            $(this).text("Read Less");
        }
    });
</script>
@endsection