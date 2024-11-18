@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="myactpagedatacov">
        <div class="myactpagedata_title">
            <h1>Account</h1>
            <p>Welcome to Profile</p>
        </div>
        <form method="POST" enctype="multipart/form-data" id="userform" action="{{ route('submit_change_profile') }}">
            <div class="myactpagedata_left">
                @csrf
                <div class="myactpagecovleft">

                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            @if(auth()->user()->photo)
                            <div id="imagePreview" style="background-image: url(<?= url('/') . '/public/' ?>{{ auth()->user()->photo }});">
                                @else
                                <!-- default image profile -->
                                <div id="imagePreview" style="background-image: url(<?= url('/') . '/public/images/user-icon.png' ?>">
                                    @endif

                                </div>
                            </div>
                            <div class="avatar-edit">
                                <input type='file' id="photo" name="photo" />
                                <!-- <label for="imageUpload"></label> -->
                                <p>Max file size is 20mb</p>
                            </div>
                        </div>
                        <!-- <div class="form-group formdatamiancov">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="">
                        </div>
                        <div class="form-group formdatamiancov">
                            <label for="">Certificates Name</label>
                            <input type="" class="form-control" id="" placeholder="">
                        </div> -->
                        
                        <!-- <div class="saveprofdata">
                    <button>Save</button>
                </div> -->
                    </div>
                </div>
                <div class="myactpagedata_right">
                    <div class="myactpagecovleft">
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
                        <br>
                        <h3>Personal Information</h3>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">First Name *</label>
                                    <input type="" class="form-control" name="name" id="name" placeholder="" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Middle Name</label>
                                    <input type="" class="form-control" name="father_name" id="father_name" placeholder="" value="{{ $user->father_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Last Name *</label>
                                    <input type="" class="form-control" name="lastname" id="lastname" placeholder="" value="{{ $user->lastname }}">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="js-example-basic-single form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Mother Name</label>
                                    <input type="" class="form-control" name="mother_name" id="mother_name" placeholder="" value="{{ $user->mother_name }}">
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="price">DOB</label>
                                    <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="" value="{{ $user->dob }}">
                                </div>
                            </div>
                            <!-- <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Marital Status</label>
                                    <select class="js-example-basic-single" name="marital_status" id="marital_status">
                                        <option value="Married">Married</option>
                                        <option value="Unmarried">Unmarried</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Divorced">Divorced </option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Contact *</label>
                                    <div class="contnumbset-cov">
                                        <h6>+91</h6>
                                        <input type="text" class="form-control" id="contact" name="contact" placeholder="" maxlength="10" value="{{ $user->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Present Address</label>
                                    <input type="" class="form-control" id="present_address" name="present_address" placeholder="" value="{{ $user->present_address  }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Religion</label>
                                    <input type="" class="form-control" id="religion" name="religion" placeholder="" value="{{ $user->religion }}">
                                </div>
                            </div> -->
                            <!-- <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Nationality</label>
                                    <input type="" class="form-control" id="nationality" name="nationality" placeholder="" value="{{ $user->nationality  }}">
                                </div>
                            </div> -->
                        </div>
                        <div class="row">

                            <div class="col-sm">
                                <div class="form-group formdatamiancov">
                                    <label for="">Permanent Address</label>
                                    <input type="" class="form-control" id="permanant_address" name="permanant_address" placeholder="" value="{{ $user->permananat_address  }}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="country_code" id="country_code">
                        <div class="saveprofdata">
                            <button type="submit">Save</button>
                        </div>

                    </div>
                </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
    });
</script>
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
            "lastname": {
                required: true,
                minlength: 1,
                maxlength: 100,
                pattern: '^[a-zA-Z ]+$'
            },
            "contact": {
                required: true,
                digits: true,
                minlength: 10,
            },
            "photo": {
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