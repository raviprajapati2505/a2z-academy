<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Traits\UserTrait;
use App\Models\TrackLecture;
use App\Models\StudentCourseHistory;

class DashboardController extends Controller
{
    use UserTrait;

    public function index()
    { 
      $track_lecture = TrackLecture::where('student_id', Auth::user()->id)->get();
      $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
          ->where('student_course_history.student_id', Auth::user()->id)
          ->where('student_course_history.is_paid', '1')
          ->get();

        return view('frontend.dashboard.index', compact('purchased_course', 'track_lecture'));
    }
}