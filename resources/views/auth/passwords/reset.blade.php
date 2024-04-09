@extends('layouts.app')

@section('content')
<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Reset Password') }}</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
			<input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group @error('email') errorsetcl @enderror">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
        </form>
    </div>
</div>
@endsection
