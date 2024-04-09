@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="classall-datacover">
        <div class="classalldata-topslt">
            <div class="classalldata-topiner">
                <!-- <h6>Class Change</h6>
                <div class="iSelect fixedWidth rounded">
                    <label for="chk">
                        <input aria-hidden="true" id="chk" type="checkbox">
                        <span class="select-label" title="Select the model">Classes</span>
                        <ul role="listbox">
                            <div class="classalllist-heightset">
                                <li role="option" class="classe8">
                                    <p>8<span>th</span></p>
                                    <h5>Calss - 8</h5>
                                </li>
                                <hr>
                                <li role="option" class="classe9">
                                    <p>9<span>th</span></p>
                                    <h5>Calss - 9</h5>
                                </li>
                                <hr>
                                <li role="option" class="classe10">
                                    <p>10<span>th</span></p>
                                    <h5>Calss - 10</h5>
                                </li>
                                <hr>
                                <li role="option" class="classe11">
                                    <p>11<span>th</span></p>
                                    <h5>Calss - 11</h5>
                                </li>
                                <hr>
                                <li role="option" class="classe12">
                                    <p>12<span>th</span></p>
                                    <h5>Calss - 12</h5>
                                </li>
                                <hr>
                            </div>
                        </ul>
                    </label>
                </div> -->
            </div>
        </div>
        @foreach($all_class as $class)
        <div class="classalldata-title">
            <p>{{ $class->name }}</p>
            <h3>Popular Course</h3>
            <div class="classalldata-inerbox">
                <div class="row">
                    @if(count($class->course) > 0)
                    @foreach($class->course as $course)
                    <div class="classalldata-box3">
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
                                    <h3><a href="{{ url('course_detail') }}<?= '/' . $course->id ?>">{{ $course->name }}</a></h3>
                                    <p class="desc_course_by_class">{{ $course->description }}</p>
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
        <br><br>
        @endforeach
    </div>
</div>
@endsection