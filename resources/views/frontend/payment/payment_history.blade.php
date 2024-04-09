@extends('layouts.app_front')

@section('content')
<div class="container">
    <div class="myactpagedatacov">
        <div class="myactpagedata_title">
            <h1>Payment History</h1>
            <p>Welcome to Payment History</p>
        </div>
        <div class="fullpageinerdata_cover">
            <div class="fullpageinerdata_iner">
                <div class="fullpageinerdata_title">
                    <h2>Purchase Courses</h2>
                </div>
                <div class="fullpageinerdata_tbl">
                    <table id="paymenttbl" class="table display">
                        <thead>
                            <tr>
                                <th>Courses Details</th>
                                <th>Price</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($purchased_course) > 0)
                            @foreach($purchased_course as $course)
                            <tr>
                                <td class="tblrowset1">
                                    @if($course->cover_image)
                                    <img src="<?= url('/') . '/public/' . $course->cover_image ?>">
                                    @else
                                    <!-- default image course -->
                                    <img src="{{ asset('public/images/my-courses-img9.jpg') }}">
                                    @endif
                                    <span>{{ $course->name }}</span>
                                </td>
                                <td class="tblrowset2">${{ $course->special_price ? $course->special_price : $course->price }}</td>
                                <td class="tblrowset3">{{ $course->course->class->name }}</td>
                                <td class="tblrowset4">
                                    <a href="javascript:void(0);">
                                        <i class='bx bx-trash'></i>
                                        Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>No courses available</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection