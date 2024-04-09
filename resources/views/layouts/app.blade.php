<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
    <style>
        body {
            background: url("{{ asset('public/images/signup-bg-img.png') }}") top center no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="signupboxformcover">
            <img src="{{ asset('public/images/logo-color.png')}}" alt="Logo" class="logoforsignup">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('public/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // validate the comment form when it is submitted
            jQuery("form").validate();
        })
    </script>
    <script src="{{ asset('public/js/custom.js') }}"></script>

</body>

</html>