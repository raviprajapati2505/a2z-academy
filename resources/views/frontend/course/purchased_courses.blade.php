@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="mycorspagedatacov">
        <div class="myactpagedata_title">
            <h1>Courses</h1>
            <p>Welcome to Courses</p>
        </div>
        <div class="row">
            @if(count($purchased_course) > 0)
            @foreach($purchased_course as $course)
            <div class="coursesdata-cover">
                <div class="coursesdata-iner">
                    <a href="javascript:void(0);">
                        <div class="coursesdata-img">
                            @if($course->cover_image)
                            <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
                            @else
                            <!-- default image course -->
                            <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
                            @endif
                        </div>
                        <div class="coursesdata-text">
                            <h3>{{ $course->name }}</h3>
                            <?php
                            $total_course_duration = 0;
                            $pp = \App\Models\Course::where('id', $course->id)->first();
                            foreach ($pp->curriculam_lecture as $lc) {
                                $total_course_duration += $lc->duration_in_seconds;
                            }
                            //$time = $total_course_duration . ':00:00';
                            //$seconds = strtotime("1970-01-01 $time UTC");
                            $total_time_in_seconds = 0;
                            foreach ($track_lecture as $track_lc) {
                                if ($track_lc->course_id == $course->id) {
                                    $total_time_in_seconds += $track_lc->time_in_seconds;
                                }
                            }
                            if ($total_course_duration > 0 && $total_time_in_seconds > 0) {
                                $total = (int)$total_time_in_seconds / (int)$total_course_duration * 100;
                                $total_course_completed = (int)$total;
                            } else {
                                $total_course_completed = 0;
                            }
                            ?>
                            <a title="Download Certificate" href="{{ asset('public/certificates/'.$course->student_id.'-'.$course->id.'-certificate.png') }}"><i class="fa fa-download"></i>Download Certificate</a>
                            
                            <div class="progress progcolor3" data-percentage="{{ $total_course_completed }}">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">
                                    <div>{{ $total_course_completed }}%</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @else
            <p>No courses available</p>
            @endif
        </div>
    </div>
</div>
@endsection