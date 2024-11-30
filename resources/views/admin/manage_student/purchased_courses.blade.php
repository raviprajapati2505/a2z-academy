@extends('layouts.app_theme')

@section('content')


<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>{{ $title }}</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
        <div class="addadmsupbtnright">
        <a href="{{ url('admin/manage_student') }}" id="create-student">
                <i class='bx bxs-arrow-back'></i> Back to listing
            </a>
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <table id="example" class="display table nowrap course_datatable">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Price</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchased_course as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->price }}</td>
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
                            <td><?= $total_course_completed . '%' ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.course_datatable').DataTable();
    });
</script>

@endsection