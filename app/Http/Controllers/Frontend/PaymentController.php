<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentCourseHistory;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment_history()
    {
        # if courses which is purchased by the student
        $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '1')
            ->get();
        return view('frontend.payment.payment_history', compact('purchased_course'));
    }

    public function manage_payment()
    {
        $is_enroll_course_id = request()->segment(2);
        # if course id exists enroll student in to the  course
        if ($is_enroll_course_id) {
            $is_already_enroll = StudentCourseHistory::where('course_id', $is_enroll_course_id)->where('student_id', Auth::user()->id)->get();
            if (count($is_already_enroll) <= 0) {
                StudentCourseHistory::create([
                    'student_id' => Auth::user()->id,
                    'course_id' => $is_enroll_course_id
                ]);
            } else {
                if ($is_already_enroll[0]->is_paid == 1) {
                    return redirect()->route('manage_payment')->withErrors(['error' => 'Course is already purchased, please check in payment history section']);
                }
            }
            
        }
        
        $pending_payment_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '0')
            ->get();
            
        return view('frontend.payment.manage_payment', compact('pending_payment_course'));
    }

    public function remove_course_enroll()
    {
        $course_id = request()->segment(2);
        $delete = StudentCourseHistory::where('student_id', Auth::user()->id)->where('course_id', $course_id)->delete();

        return redirect('/manage_payment')->with('success', 'Course remove successfully');
    }

    public function pay_for_courses()
    {
        StudentCourseHistory::where('student_id', Auth::user()->id)
            ->where('is_paid', '0')
            ->update(['is_paid' => '1']);

        return back()->with('success', 'Payment made successfully');
    }
}
