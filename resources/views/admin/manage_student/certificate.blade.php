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
                <i class='bx bxs-plus-circle'></i> Back to listing
            </a>
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="supadmmain_maintbl">
                <form method="POST" enctype="multipart/form-data" action="{{ route('save_certificate', ['id' => request()->segment(3)]) }}">
                    @csrf
                    <div class="myactpagedata_left">
                        <div class="row">
                            <div class="col-md-6">
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
                                        <label for="">Select Course</label>
                                        <select class="form-control" name="course_id" id="course_id">
                                            @foreach($purchased_course as $course)
                                            <option value="$course->id">{{$course->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group formdatamiancov">
                                        <label for="">Certificate Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="">
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

                                    <div class="form-group formdatamiancov">
                                        <label for="">Expiry Date</label>
                                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="" placeholder="">
                                    </div>

                                    <div class="form-group formdatamiancov">
                                        <label for="">Refrence Number</label>
                                        <input type="text" class="form-control" id="reference_number" name="reference_number" value="" placeholder="">
                                    </div>

                                    <div class="certifformtestnot">
                                        <p>Once the certificate has been created, the name cannotbe changed again, so carefully review your name before submitting.</p>
                                    </div>
                                    <!-- <div class="saveprofdata">
                                        <button>Save</button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="myactpagedata_right">
                                    <div class="myactpagecovleft">
                                        <h3>Certificate Preview</h3>
                                        <div class="certifimgdatacov">
                                            <img style="width:100%" src="{{ asset('public/frontend/images/certificates-img1.png') }}" alt="">
                                        </div>
                                        <div class="certifdownlodbtn">
                                            <br><br>
                                            <div class="saveprofdata">
                                                <button type="submit">Generate</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection