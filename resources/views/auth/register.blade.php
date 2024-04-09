@extends('layouts.app_front')

@section('content')

<div class="container">
    <div class="loginsighup-main">
        <div class="loginsighup-left">
            <img src="{{ asset('public/images/login-img1.png') }}" alt="">
        </div>
        <div class="loginsighup-right">
            <div class="loginsighuptitle">
                <h1>{{ __('Register') }}</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                <div class="loginformbox">
                    @csrf
                    <div class="form-group @error('name') errorsetcl @enderror">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('email') errorsetcl @enderror">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('password') errorsetcl @enderror">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        @error('password')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        @error('password')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </form>
            <div class="orsignwithbtntx">
                <h3>Or Sign in with</h3>
                <a href="javascript:void(0);">
                    <img src="images/google-icon.png" alt="">
                    <span>Google</span>
                </a>
                <a href="javascript:void(0);">
                    <img src="images/facebook-icon.png" alt="">
                    <span>Facebook</span>
                </a>
            </div>
            <div class="signinboxbtnlastfogo">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </div>
</div>

<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Register') }}</h1>

    </div>
</div>
@endsection