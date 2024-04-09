@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="loginsighup-main chngpassformpagcov">
        <div class="loginsighup-left">
            <img src="{{ asset('public/images/login-img1.png') }}" alt="">
        </div>
        <div class="loginsighup-right">
            <div class="loginsighuptitle">
                <h1>Change password</h1>
            </div>
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
            <form method="POST" id="password-change-form" action="{{ route('submit_change_password') }} ">
                @csrf
                <div class="loginformbox">
                    <div class="form-group">
                        <label for="">Enter Old Password</label>
                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Enter New Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection