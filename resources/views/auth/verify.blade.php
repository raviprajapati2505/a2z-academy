@extends('layouts.app')

@section('content')
<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Verify Your Email Address') }}</h1>
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>.
        </form>
    </div>
</div>

@endsection