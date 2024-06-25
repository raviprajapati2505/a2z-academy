@extends('layouts.app_front')

@section('content')
<div class="container">
    <br>
    @if($errors->any())
    <div class="alert alert-danger mb-0" role="alert">
        {{$errors->first()}}
    </div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="classdetails-cover">
        <div class="classdetails-left">
            <div class="classdetails-covlr">
                <div class="class-mainvideo">
                    <video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" width="780" height="400" poster="{{ asset('public/images/my-courses-img9.jpg') }}" data-setup='{ "controls": true, "preload": "auto","liveui": true }'>
                        <source src="<?= url('/') . '/public/' . $lecture->video ?>" type="video/mp4" />
                        <source src="<?= url('/') . '/public/' . $lecture->video ?>" type="video/webm" />
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                </div>
                <div class="classvideodeta-main">
                    <div class="classvideo-details">
                        <div class="classvideodet-left">
                            <h3>{{ $lecture->title }}</h3>
                            <?php
                            $total_start_rating = 0;
                            foreach ($course->student_review as $rating) {
                                $total_start_rating += $rating->star_rating;
                            }
                            ?>
                            <!-- <p>
                                <?php
                                if (count($course->student_review) == 0) {
                                    $avg_rating = '5';
                                } else {
                                    $avg_rating = $total_start_rating / count($course->student_review);
                                }
                                for ($x = 0; $x < round($avg_rating); $x++) {
                                    echo '<i class="bx bxs-star active"></i>';
                                }
                                for ($x = 0; $x < 5 - round($avg_rating); $x++) {
                                    echo '<i class="bx bxs-star"></i>';
                                }
                                ?>
                                <span>{{ round($avg_rating) }}</span>
                                {{ count($course->student_review)}} Reviews
                            </p> -->
                        </div>
                        <!-- <div class="classvideodet-right">
                            <a href="javascript:void(0);">
                                <i class="bx bx-time-five"></i>
                            </a>
                            <a href="javascript:void(0);" class="active mark_favrouite">
                                <i class="bx bxs-heart"></i>
                            </a>
                            <a href="javascript:void(0);">
                                <i class="bx bxs-share-alt"></i>
                            </a>
                            <p class="msg" style="color:green"></p>
                        </div> -->
                    </div>
                    <div class="holestunen-main">
                        <!--<div class="holestunen-iner">
                            <img src="{{ asset('public/frontend/svg/holestunen-icon-1.svg') }}" alt="">
                            <?php
                            $total_course_duration = 0;
                            $total_student_enroll = 0;
                            foreach ($course->curriculam_lecture as $lecture) {
                                $total_course_duration += $lecture->duration_in_hour;
                            }
                            foreach ($course->student_course_history as $student_enrolled) {
                                if ($student_enrolled->is_paid == 1) {
                                    $total_student_enroll += 1;
                                }
                            }
                            ?>
                            <p>{{ $total_course_duration }} hours</p>
                        </div>
                        <div class="holestunen-iner">
                            <img src="{{ asset('public/frontend/svg/holestunen-icon-2.svg') }}" alt="">
                            <p>{{ count($course->curriculam_lecture) }} Lectures</p>
                        </div>
                        <div class="holestunen-iner">
                            <img src="{{ asset('public/frontend/svg/holestunen-icon-3.svg') }}" alt="">
                            <p>{{ $total_student_enroll }} Trainee Enrolled</p>
                        </div> -->
                        <h3>{{ $lecture->description }}</h6>
                    </div>
                    <div class="priceandbtnrightleft">
                        <h3><a href="{{ url('/course_detail')}}<?= '/' . $course->id ?>"><span>Back to course</span></a></h3>
                        <!-- <h3>
                            <?php if ($course->is_paid == 1) {
                                if ($course->special_price) {
                            ?>
                                    <span>$ {{ $course->special_price }}</span>
                                <?php } else { ?>
                                    <span>$ {{ $course->price }}</span>
                                <?php } ?>
                            <?php } else { ?>
                                <span>Free Course</span>
                            <?php } ?>
                        </h3>
                        <?php if ($course->is_paid == 1) { ?>
                            <a href="<?= url('/manage_payment') . '/' . $course->id ?>" class="clascorebrolnow">Enroll Now</a>
                        <?php }
                        ?> -->
                    </div>
                </div>
            </div>
            <div class="classdetails-covlr cocimainboxset1">
                <div class="classdetails-titlemn">
                    <h3>Course Curriculam</h3>
                </div>
                <div class="course-circullum-list">
                    <div class="accordion" id="accordionExample">
                        @if(count($curriculams) > 0)
                        @foreach($curriculams as $curriculam)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $curriculam->id }}" aria-expanded="false" aria-controls="collapse_{{ $curriculam->id }}">
                                    {{ $curriculam->title }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $curriculam->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="alltopdatain-main">
                                        <?php $index = 1 ?>
                                        @foreach($curriculam->curriculam_lecture as $lecture)
                                        <div class="alltopdatain-cover">
                                            <div class="alltopdatain-left">
                                                <i class='bx bx-play'></i>
                                            </div>

                                            <div class="alltopdatain-mind">
                                                <p><span>Lecture: {{ $index }}</span>
                                                    {{ $lecture->title }}
                                                </p>
                                            </div>
                                            <div class="alltopdatain-right">
                                                <?php
                                                if ($course->is_paid == 0 || $lecture->is_free == 0 || $is_purchased == 1) {
                                                    $url = url('lecture_player') . '/' . $course->id . '/' . $lecture->id;
                                                    $icon = '/svg/view-icon.svg';
                                                } else {
                                                    $url = 'block';
                                                    $icon = '/svg/lock-icon.svg';
                                                }
                                                ?>
                                                <a href="{{ $url }}" class="<?= $url ?>" data-lecture_video="{{ $lecture->video }}">
                                                    <img src="{{ asset('public/frontend/') }}<?= $icon ?>" alt="">
                                                </a>
                                            </div>

                                        </div>
                                        <hr>
                                        <?php $index++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No curriculam available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="classdetails-right">
            <div class="classdetails-covright">
                <div class="classdetails-teachers">
                    <h2>Instructors</h2>
                    @foreach($course_teachers as $teacher)
                    <div class="teacherslist-cov">
                        <a href="javascript:void(0);">
                            @if($teacher->teacher->photo)
                            <img src="<?= url('/') . '/public/' ?>{{ $teacher->teacher->photo }}">
                            @else
                            <!-- default image profile -->
                            <img src="{{ asset('public/images/user-icon.png') }}" alt="Allie Grater">
                            @endif
                            <h3>{{ $teacher->teacher->name }}</h3>
                            <p>Exp. {{ $teacher->teacher->years_experience ?:0  }} Year | {{ count($teacher->teacher->curriculam_lecture)}} Lectures</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="classdetails-covright">
                <div class="classdetails-teachers">
                    <h2>Course Features</h2>
                    <div class="coursefeatures-list">
                        <p>Trainee Enrolled:</p>
                        <h3>{{ $total_student_enroll }}</h3>
                    </div>
                    <div class="coursefeatures-list">
                        <p>lectures:</p>
                        <h3>{{ count($course->curriculam_lecture) }}</h3>
                    </div>
                    <div class="coursefeatures-list">
                        <p>Duration:</p>
                        <h3>{{ $total_course_duration }} hours</h3>
                    </div>
                    <div class="coursefeatures-list">
                        <p>Language:</p>
                        <h3>{{ $course->language }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="classformcon-cover">
        <div class="classformcon-left">
            <div class="classdetails-covlr cocimainboxset1">
                <div class="classdetails-titlemn">
                    <h3>Submit Reviews</h3>
                </div>
                <div class="classformcon-inerform">
                    <form method="POST" enctype="multipart/form-data" id="userform" action="{{ route('submit_student_review') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="" class="form-control" value="{{ auth()->user()->name }}" id="name" name="name" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="" class="form-control" readonly id="email" name="email" value="{{ auth()->user()->email }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Review</label>
                                    <textarea class="form-control" id="feedback_text" name="feedback_text" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Star</label>
                                    <select class="js-example-basic-single" name="star_rating" id="star_rating">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5" selected>5 Star</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="lecture_id" id="lecture_id" value="{{ $lecture->id }}">
                        <input type="hidden" name="current_time" id="current_time" value="{{ $track_lecture->time_in_seconds }}">
                        <div class="saveprofdata">
                            <button type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="classformcon-right">
            <div class="classformcon-inermain">
                <img src="{{ asset('public/images/logo.png') }}" alt="" class="logolftcls">
                <img src="{{ asset('public/frontend/images/class-details-img1.png')}}" alt="" class="class-details-img">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#userform").validate({
        ignore: [],
        rules: {
            "feedback_text": {
                required: true,
            },
            "star_rating": {
                required: true,
            },
        },
        messages: {},
        submitHandler: function() {
            return true;
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('.mark_favrouite').click(function() {
        var store = <?php echo json_encode(route('mark_as_favourite')) ?>;
        $.ajax({
            data: {
                course_id: $('#course_id').val()
            },
            url: store,
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('.msg').text(data.message);
                    setTimeout(function() {
                        $('.msg').text('')
                    }, 2000);
                } else if (data.message == 'Error validation') {
                    for (var key in data.data) {
                        var value = data.data[key];
                        $('#alert-danger-form').text(value[0]);
                    }
                } else {
                    $('.msg').text(data.message)
                }
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });
</script>
<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
<script type="text/javascript">
    var videoPlayer = window.videoPlayer = videojs('my-video', {
        title: '',
        liveui: true
    })
    videoPlayer.one("loadedmetadata", () => {
        var duration = videoPlayer.duration();
        var user_last_watch_time = $('#current_time').val() ? $('#current_time').val() : 0;
        videoPlayer.currentTime(user_last_watch_time);
    });
    var player = $("#my-video_html5_api")[0];
    var is_fully_watched = '<?= $track_lecture->is_fully_watched ?>';
    player.addEventListener('timeupdate', function() {
        var current_time = player.currentTime;
        if (Math.round(current_time) % 10 == 0 && is_fully_watched == 0) {
            /* save vidoe history periodically  */
            var store = <?php echo json_encode(route('track_lecture')) ?>;
            $.ajax({
                data: {
                    lecture_id: $('#lecture_id').val(),
                    current_time: current_time,
                    course_id: $('#course_id').val(),
                    total_video_duration: videoPlayer.duration()
                },
                url: store,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        console.log('Video track saved successfully');
                    } else if (data.message == 'Error validation') {
                        console.log('Error in video tracking');
                    } else {
                        console.log('Error in video tracking');
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        }
    });
</script>
<script>
        // Disable right-click context menu for the entire document
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });

        // Disable right-click context menu specifically for video elements
        document.querySelectorAll('video').forEach(function(video) {
            video.addEventListener('contextmenu', function(event) {
                event.preventDefault();
            });
        });

        // Disable certain key combinations
        document.addEventListener('keydown', function(event) {
            // Prevent Ctrl+U (view source), Ctrl+Shift+I (dev tools), F12 (dev tools), Ctrl+Shift+J (dev tools)
            if ((event.ctrlKey && event.key === 'u') || 
                (event.ctrlKey && event.shiftKey && event.key === 'I') || 
                (event.key === 'F12') || 
                (event.ctrlKey && event.shiftKey && event.key === 'J')) {
                event.preventDefault();
            }
        });
    </script>
@endsection