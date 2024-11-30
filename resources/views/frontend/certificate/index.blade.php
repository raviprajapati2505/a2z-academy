@extends('layouts.app_front')

@section('content')

<div class="container">
    <div class="myactpagedatacov">
        <div class="myactpagedata_title">
            <h1>Certificates</h1>
            <p>Welcome to Certificates</p>
        </div>
        <form method="POST" enctype="multipart/form-data" id="userform" action="{{ route('download_certificate') }}">
            @csrf
            <div class="myactpagedata_left">

                <div class="myactpagecovleft">
                    <div class="chosphocertinote">
                        <p>Choose photo for the certificate</p>
                    </div>
                    <div class="avatar-upload">
                        <!-- default image profile -->
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url(<?= url('/') . '/public/images/user-icon.png' ?>" )">
                            </div>
                        </div>
                        <div class="avatar-edit">
                            <input type='file' name="file" id="imageUpload" />
                            <!-- <label for="imageUpload"></label> -->
                            <p>Max file size is 20mb</p>
                        </div>
                    </div>
                    <div class="form-group formdatamiancov">
                        <label for="">Certificate Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" placeholder="">
                    </div>
                    <div class="form-group formdatamiancov">
                        <label for="">Certificate Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="" placeholder="">
                    </div>
                    <div class="form-group formdatamiancov">
                        <label for="">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="" placeholder="">
                    </div>
                    <div class="form-group formdatamiancov">
                        <label for="">Organization</label>
                        <input type="text" class="form-control" id="organization" name="organization" value="" placeholder="">
                    </div>

                    <div class="certifformtestnot">
                        <p>Once the certificate has been created, the name cannotbe changed again, so carefully review your name before submitting.</p>
                    </div>
                    <input type="hidden" name="course_id" value="1" id="course_id">
                    @foreach($purchased_course as $course)
                    <?php
                    $total_course_duration = 0;
                    $total_ceu_points = 0;
                    $pp = \App\Models\Course::where('id', $course->id)->first();
                    foreach ($pp->curriculam_lecture as $lc) {
                        $total_course_duration += $lc->duration_in_seconds;
                    }
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
                    @if($total_course_completed >= 99)
                    <? $total_ceu_points += $course->ceu_points ?>
                    @endif
                    @endforeach
                    <button type="button" class="btn btn-primary">
                        Learning Hours (LH) Earned <span class="badge badge-light"><?= $total_ceu_points ?></span>
                        <span class="sr-only"></span>
                    </button>
                    <!-- <div class="saveprofdata">
                        <button>Save</button>
                    </div> -->
                </div>
            </div>
            <div class="myactpagedata_right">
                <div class="myactpagecovleft">
                    <h3>Your Certificate</h3>
                    <div class="certifimgdatacov">
                        <img src="{{ asset('public/frontend/images/certificates-img1.png') }}" alt="">
                    </div>
                    <div class="certifdownlodbtn">
                        @if(last(request()->segments()) != 'certificate')
                        <div class="saveprofdata">
                            <button type="submit">Download</button>
                        </div>
                        @else
                        <p>You do not currently have any certificates. Enroll in a course today or if you have already enroll then please complete the course curriculam first !</p>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#userform").validate({
        ignore: [],
        rules: {
            "name": {
                required: true,
                minlength: 1,
                maxlength: 100,
                pattern: '^[a-zA-Z ]+$'
            },
            "file": {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        messages: {
            "photo": {
                extension: "Allow file type is jpeg, png, jpg"
            },
        },
        submitHandler: function() {
            return true;
        }
    });
</script>
@endsection