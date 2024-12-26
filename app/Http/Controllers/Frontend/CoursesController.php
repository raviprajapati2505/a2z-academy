<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\CourseCurriculam;
use App\Models\CurriculamLecture;
use App\Models\StudentCourseHistory;
use App\Models\StudentFavourite;
use App\Models\TrackLecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function course_detail()
    {
        $course_id = request()->segment(2);
        $course = Course::where('id', $course_id)->get()[0];

        $curriculams = CourseCurriculam::where('course_id', $course_id)->orderby('display_order', 'asc')->get();
        $course_teachers = CurriculamLecture::select('teacher_id')->where('course_id', $course_id)->distinct()->get();
        $check_student_paid = StudentCourseHistory::where('student_id', Auth::user()->id)->where('course_id', $course_id)->get();
        $check_mark_favourite = StudentFavourite::where('student_id',Auth::user()->id)->where('course_id', $course_id)->count();
        $is_purchased = 0;
        if (count($check_student_paid) > 0) {
            $is_purchased = 1;
        }
        return view('frontend.course.course_detail', compact('course', 'curriculams', 'course_teachers', 'is_purchased','check_mark_favourite'));
    }

    public function lecture_player()
    {
        $course_id = request()->segment(2);
        $course = Course::where('id', $course_id)->get()[0];

        $curriculams = CourseCurriculam::where('course_id', $course_id)->orderby('display_order', 'asc')->get();
        $course_teachers = CurriculamLecture::select('teacher_id')->where('course_id', $course_id)->distinct()->get();
        $check_student_paid = StudentCourseHistory::where('student_id', Auth::user()->id)->where('course_id', $course_id)->get();
        $is_purchased = 0;
        if (count($check_student_paid) > 0) {
            $is_purchased = 1;
        }
        $lecture = CurriculamLecture::where('id', request()->segment(3))->first();
        $track_lecture = TrackLecture::where('student_id', Auth::user()->id)->where('course_id', $course_id)->first();
        return view('frontend.course.lecture_player', compact('course', 'curriculams', 'course_teachers', 'is_purchased', 'lecture', 'track_lecture'));
    }

    public function purchased_courses()
    {
        $track_lecture = TrackLecture::where('student_id', Auth::user()->id)->get();
        $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '1')
            ->get();
        return view('frontend.course.purchased_courses', compact('purchased_course', 'track_lecture'));
    }

    public function course_by_class(Request $request)
    {
        if (request()->segment(2) == 'all') {
            $all_class = ClassList::all();
        } else {
            $all_class = ClassList::where('id', request()->segment(2))->get();
        }
        return view('frontend.course.course_by_class', compact('all_class'));
    }

    public function course_by_type()
    {
        if (request()->segment(2) == 'all') {
            $all_course_types = CourseType::where("is_delivery_mode", 0)->get();
        } else {
            $all_course_types = CourseType::where('id', request()->segment(2))->get();
        }
        return view('frontend.course.course_by_type', compact('all_course_types'));
    }

    public function course_by_delivery_mode()
    {
        $courses = Course::where('delivery_mode_id',request()->segment(2))->get();
        $title = CourseType::find(request()->segment(2))['title'];
        return view('frontend.course.course_by_delivery_mode', compact('courses','title'));
    }

    public function track_lecture(Request $request)
    {
        try {
            $data = [
                'curriculam_lecture_id' => $request->lecture_id,
                'student_id' => Auth::user()->id,
                'time_in_seconds' => $request->current_time,
                'course_id' => $request->course_id,
                'total_video_duration' => $request->total_video_duration,
            ];

            $lecture = CurriculamLecture::where('id', $request->lecture_id)->first();
            $lecture->duration_in_seconds = (int)$request->total_video_duration;
            $lecture->save();

            $tentative = (int)$request->total_video_duration - 10;

            # check is user has fully watched or not
            if ($request->current_time > $tentative) {
                $data['is_fully_watched'] = '1';
                $data['time_in_seconds'] = (int)$request->total_video_duration;
            }
            $track = TrackLecture::updateOrCreate(
                [
                    'student_id' => Auth::user()->id,
                    'curriculam_lecture_id' => $request->lecture_id,
                ],
                $data
            );
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Video track saved successfully'
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
