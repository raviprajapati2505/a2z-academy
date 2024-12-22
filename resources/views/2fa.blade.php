@extends('layouts.app')

@section('content')

<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('2-Step Verification') }}</h1>
        <form method="POST" action="{{ route('2fa.post') }}">
            @csrf

            @if ($message = Session::get('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
            @endif

            <div class="entrveriftextset">
                <p>Enter the verification code sent to you on your email address.</p>
                <!-- <p class="text-center">We sent code to email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p> -->
            </div>
            <!-- <div class="form-group @error('email') errorsetcl @enderror">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="errortext">{{ $message }}</p>
                @enderror
            </div> -->

            <div class="form-group @error('code') errorsetcl @enderror">
                <label for="code">Code</label>
                <input id="code" type="number" class="form-control " name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                @error('code')
                <p class="errortext">{{ $message }}</p>
                @enderror
            </div>

            <div class="keepacoutextset" style="display:none">
                <p><b>Your OTP for login is : {{ $user ? $user[0]->code : '' }}</b></p>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit Code') }}</button>
        </form>
        <div class="havactboxsetcov">
            <p>Didn't get the code? <a href="{{ route('2fa.resend') }}">Resend</a></p>
        </div>
    </div>
</div>
@endsection