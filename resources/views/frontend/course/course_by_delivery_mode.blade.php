@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="classall-datacover">
        <div class="classalldata-topslt">
            <div class="classalldata-topiner">
                <!-- <h6>Class Change</h6>
                <div class="iSelect fixedWidth rounded rectcourrecenew1">
                    <label for="chk">
                        <input aria-hidden="true" id="chk" type="checkbox">
                        <span class="select-label" title="Select the model">Recent Courese</span>
                        <ul role="listbox">
                            <div class="classalllist-heightset">
                                <li role="option">
                                    <h3>Popular Courses</h3>
                                </li>
                                <hr>
                                <li role="option">
                                    <h3>Recent Courses</h3>
                                </li>
                                <hr>
                                <li role="option">
                                    <h3>Featured Courses</h3>
                                </li>
                            </div>
                        </ul>
                    </label>
                </div> -->
            </div>
        </div>
        <div class="classalldata-title">
            <!-- <p>Skill</p> -->
            <h3>{{ $title}}</h3>
            <div class="classalldata-inerbox">

                <div class="row">
                    @foreach($courses as $course)
                    <div class="classalldata-box3">
                        <div class="coursesdata-cover">
                            <div class="coursesdata-iner">
                                <div class="coursesdata-img">
                                    <div class="timeclocbox1">
                                        <?php
                                        $total_course_duration = 0;
                                        foreach ($course->curriculam_lecture as $lecture) {
                                            $total_course_duration += $lecture->duration_in_hour;
                                        }
                                        ?>
                                        <!-- <p style="font-size:17px">
                                            <i class="bx bx-time-five"></i>
                                            <span>{{ $total_course_duration }} hr</span>
                                        </p> -->
                                    </div>
                                    @if($course->cover_image)
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
                                    @else
                                    <!-- default image course -->
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
                                    @endif
                                </div>
                                <div class="coursesdata-skilcls">
                                    <h3><a href="{{ url('course_detail') }}<?= '/' . $course->id ?>">{{ $course->name }}</a></h3>
                                    <div class="popucours-sldin">

                                        <?php if ($course->is_paid == 1) {
                                            if ($course->special_price) {
                                        ?>
                                                <h4>${{ $course->special_price }}</h4>
                                                <h6>${{ $course->price }}</h6>
                                            <?php } else { ?>
                                                <h4>${{ $course->price }}</h4>
                                            <?php } ?>
                                            <a href="<?= url('/manage_payment') . '/' . $course->id ?>">Enroll Now</a>
                                        <?php } else { ?>
                                            <h4>Free Course</h4>
                                            <a href="<?= url('/course_detail') . '/' . $course->id ?>">View Course</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection