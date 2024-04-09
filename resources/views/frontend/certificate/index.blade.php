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
                        <label for="">Enter the name for the certificate</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" placeholder="">
                    </div>
                    <div class="certifformtestnot">
                        <p>Once the certificate has been created, the name cannotbe changed again, so carefully review your name before submitting.</p>
                    </div>
                    <input type="hidden" name="course_id" value="1" id="course_id">
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
                maxlength: 20,
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