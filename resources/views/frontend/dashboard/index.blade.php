@extends('layouts.app_front')

@section('content')

<div class="container">
    <div class="myactpagedatacov">
        <div class="myactpagedata_title">
            <!-- <h1>Dashboard</h1>
            <p>Welcome to Events</p> -->
        </div>
        <div class="col comtitledata-cover">
            <h1>Dashboard</h1>
            <p>Welcome to Gord Academy</p>
            <img src="{{ asset('public/images/title-background-dashboard.png') }}" alt="Welcome to Gord Academy">
        </div>
        <div class="fullpageinerdata_cover">
            <div class="fullpageinerdata_iner">
                <div class="row">
                    <div class="col-sm smcoldatrispo">
                        <div class="todayclass-cover">
                            <h2 class="todayclass-title">Video Courses</h2>
                            <div class="classlistofall">
                                @if(count($purchased_course) > 0)
                                @foreach($purchased_course as $course)
                                <div class="classlistof_cover">
                                    @if($course->cover_image)
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="<?= url('/') . '/public/' . $course->cover_image ?>"></a>
                                    @else
                                    <!-- default image course -->
                                    <a href="{{ url('course_detail') }}<?= '/' . $course->id ?>"><img src="{{ asset('public/images/my-courses-img9.jpg') }}" alt="Allie Grater"></a>
                                    @endif
                                    <h4>{{ $course->name }}</h4>
                                    <?php
                                    $total_course_duration = 0;
                                    $pp = \App\Models\Course::where('id', $course->id)->first();
                                    if ($pp && $pp->curriculam_lecture) {
                                        foreach ($pp->curriculam_lecture as $lc) {
                                            $total_course_duration += $lc->duration_in_seconds;
                                        }
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
                                @endforeach
                                @else
                                <p>No courses available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="col-sm smcoldatrispo">
                        <div class="timespentchartset">
                            <h2 class="todayclass-title">Events</h2>
                            <div class="timespentchart-cover">
                                <div class="timespentchart-top">
                                    <img src="{{ asset('public/images/time-spent-img.png') }}" alt="Time Spent">
                                    <h4>Upcoming Events</h4>
                                </div>

                                <div class="comcharttimedata">
                                    <h5>10</h5>
                                    <!-- <div id="doughnutChart" class="chart"></div> -->
                                    <div class="chartinerdata-com">
                                        @foreach($events as $event)
                                        @php
                                            if ($event->type == 'Event') {
                                                $color = '#211C77';
                                            } else if ($event->type == 'Exam') {
                                                $color = '#F3E500';
                                            } else if ($event->type == 'Other') {
                                                $color = '#096C04';
                                            } else if ($event->type == 'Workshop') {
                                                $color = 'gray';
                                            } else if ($event->type == 'Wrapup') {
                                                $color = '#6b2956';
                                            }
                                        @endphp
                                        <div class="allcomdatacover">
                                            <span style="background: <?= $color ?>"></span>
                                            <p>{{$event->description}}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/chart.js') }}"></script>
@endsection