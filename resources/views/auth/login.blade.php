@extends('layouts.app_front')

@section('content')
<style>
    .position-relative {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        /* Adjust position */
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        /* Optional: Gray color */
    }

    .form-control {
        padding-right: 30px;
        /* Add space for the icon */
    }
</style>
<div class="container">
    <div class="loginsighup-main">
        <div class="loginsighup-left">
            <img src="{{ asset('public/frontend/images/image-banner-1.png') }}" alt="">
        </div>
        <div class="loginsighup-right">
            <div class="loginsighuptitle">
                <h1>Log In</h1>
            </div>
            @if($errors->any())
            <div class="alert alert-danger mb-0" role="alert">
                {{$errors->first()}}
            </div>
            @endif
            <br><br>
            <form method="POST" action="{{ route('login') }}">
                <div class="loginformbox">
                    @csrf
                    <div class="form-group @error('email') errorsetcl @enderror">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('password') errorsetcl @enderror">
                        <label for="password">Password</label>
                        <div class="position-relative">
                            <input id="password" type="password" class="form-control pr-4" name="password" required autocomplete="new-password">
                            <span class="toggle-password position-absolute" data-target="#password">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                        @error('password')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="chboxforgot">
                        <div class="custom_checkbox">
                            <label class="control control--checkbox">
                                <p>{{ __('Remember Me') }}</p>
                                <input type="checkbox" checked="checked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <div class="forgotpass">
                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>
                        @endif

                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>
            </form>
            <!-- <div class="orsignwithbtntx">
                <h3>Or Sign in with</h3>
                <a href="javascript:void(0);">
                    <img src="images/google-icon.png" alt="">
                    <span>Google</span>
                </a>
                <a href="javascript:void(0);">
                    <img src="images/facebook-icon.png" alt="">
                    <span>Facebook</span>
                </a>
            </div> -->
            <div class="signinboxbtnlastfogo">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.toggle-password').on('click', function() {
            const target = $($(this).data('target')); // Get target input field
            const icon = $(this).find('i'); // Get the icon inside the clicked element

            if (target.attr('type') === 'password') {
                target.attr('type', 'text'); // Change to text
                icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye-slash
            } else {
                target.attr('type', 'password'); // Change back to password
                icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye
            }
        });
    });
</script>
@endsection