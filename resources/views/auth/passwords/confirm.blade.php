@extends('layouts.app')

@section('content')
<div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Confirm Password') }}</h1>
		{{ __('Please confirm your password before continuing.') }}
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="form-group @error('password') errorsetcl @enderror">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" autofocus>
                @error('password')
                <p class="errortext">{{ $message }}</p>
                @enderror
            </div>
			
            <button type="submit" class="btn btn-primary">{{ __('Confirm Password') }}</button>
        </form>
    </div>
</div>
@endsection
