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
            <img src="{{ asset('public/images/login-img1.png') }}" alt="">
        </div>
        <div class="loginsighup-right" style="overflow: scroll;height: 713px;">
            <div class="loginsighuptitle">
                <h1>{{ __('Sign up') }}</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                <div class="loginformbox">
                    @csrf
                    <div class="form-group">
                        <label for="appellations">{{ __('Select Appellation *') }}</label>
                        <select id="appellations" class="form-control" name="appellations" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                        </select>
                    </div>
                    <div class="form-group @error('name') errorsetcl @enderror">
                        <label for="name">First Name *</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('last_name') errorsetcl @enderror">
                        <label for="last_name">Last Name *</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('email') errorsetcl @enderror">
                        <label for="email">Email *</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Mobile Number *') }}</label>
                        <input id="phone" type="text" class="form-control" name="phone" required style="width:557px" value="{{ old('phone') }}">
                        @error('phone')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="membership">{{ __('Membership *') }}</label>
                        <select id="membership" class="form-control" name="membership" required>
                            <option value="">Select </option>
                            <option value="AEE">AEE</option>
                            <option value="GSAS Operations">GSAS Operations</option>
                            <option value="GSAS Construction Management">GSAS Construction Management</option>
                            <option value="GSAS Design & Build">GSAS Design & Build</option>
                            <option value="GSAS-CGP Associate">GSAS-CGP Associate</option>
                            <option value="GSAS-CGP Licentiate">GSAS-CGP Licentiate</option>
                            <option value="GSAS-CGP Practitioner">GSAS-CGP Practitioner</option>
                            <option value="Service Provider - GSAS Design & Build">Service Provider - GSAS Design & Build</option>
                            <option value="Service Provider - GSAS Operations">Service Provider - GSAS Operations</option>
                            <option value="Service Provider - GSAS Construction Management">Service Provider - GSAS Construction Management</option>
                            <option value="Not Available">Not available</option>
                        </select>
                        @error('membership')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company_name">{{ __('Company Name *') }}</label>
                        <input id="company_name" type="text" class="form-control" name="company_name" required value="{{ old('company_name') }}">
                        @error('company_name')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prefession">{{ __('Profession *') }}</label>
                        <input id="prefession" type="text" class="form-control" name="prefession" required value="{{ old('prefession') }}">
                        @error('prefession')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dob">{{ __('DOB *') }}</label>
                        <input id="dob" type="text" class="form-control datepicker" name="dob" required value="{{ old('dob') }}">
                        @error('dob')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">{{ __('Gender *') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group @error('password') errorsetcl @enderror">
                        <label for="password">Password *</label>
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
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password *') }}</label>
                        <div class="position-relative">
                            <input id="password-confirm" type="password" class="form-control pr-4" name="password_confirmation" required autocomplete="new-password">
                            <span class="toggle-password position-absolute" data-target="#password-confirm">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                        @error('password')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">{{ __('Are you ?') }}</label>
                        <select id="role" class="form-control" name="role" required>
                            <option value="Student">Learner</option>
                            <option value="Teacher">Instructor</option>
                        </select>
                        @error('role')
                        <p class="errortext">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Sign up') }}</button>
                </div>
                <input type="hidden" name="country_code" id="country_code">
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
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </div>
</div>

<!-- <div class="signupboxform-main">
    <div class="signupboxform-iner">
        <h1>{{ __('Register') }}</h1>

    </div>
</div> -->
<script type="text/javascript">
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        separateDialCode: true,
        customPlaceholder: function(
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });

    var iti = window.intlTelInputGlobals.getInstance(input);
    setTimeout(function() {
        iti.setCountry($('#country_code').val());
    }, 3000);
    input.addEventListener('blur', function() {
        var countryCode = iti.getSelectedCountryData().iso2;
        $('#country_code').val(countryCode);
    });

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
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
    });
</script>
@endsection