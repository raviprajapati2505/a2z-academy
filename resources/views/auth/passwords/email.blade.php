@extends('layouts.app')

@section('content')
<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Reset Password') }}</h1>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group @error('email') errorsetcl @enderror">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <p class="errortext">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
        </form>
    </div>
</div>
@endsection