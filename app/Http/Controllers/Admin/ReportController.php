<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ClassList;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\StudentCourseHistory;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {}

    public function totalEnrollmentReport(Request $request)
    {
        if ($request->ajax()) {
            $query = StudentCourseHistory::select('courses.*', 
            'student_course_history.*', 
            'users.firstname as firstname', 
            'student_course_history.created_at as purchased_date', 
            'curriculam_lectures.teacher_id as course_teacher')
            ->distinct() // Ensure distinct courses
            ->leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->leftJoin('curriculam_lectures', 'curriculam_lectures.course_id', '=', 'courses.id')
            ->leftJoin('users', 'users.id', '=', 'student_course_history.student_id')
                ->where('student_course_history.is_paid', '1');

            if (!empty($request->from_date) && !empty($request->to_date)) {
                $query->whereBetween(DB::raw('DATE(student_course_history.created_at)'), [$request->from_date, $request->to_date]);
            }

            if (!empty($request->class)) {
                $query->where('courses.class_id', $request->class);
            }

            if (!empty($request->subject)) {
                $query->where('courses.subject_id', $request->subject);
            }

            if (!empty($request->course)) {
                $query->where('courses.id', $request->course);
            }

            if (!empty($request->course_type)) {
                $query->where('courses.course_type_id', $request->course_type);
            }

            if (!empty($request->delivery_mode)) {
                $query->where('courses.delivery_mode_id', $request->delivery_mode);
            }

            if (!empty($request->instructor)) {
                $query->where('curriculam_lectures.teacher_id', $request->instructor);
            }

            if (!empty($request->learners)) {
                $query->where('student_course_history.student_id', $request->learners);
            }

            $data = $query->get();

            return Datatables::of($data)->addIndexColumn()->addColumn('purchased_date', function ($row) {
                return $row->purchased_date;
            })
                ->rawColumns(['purchased_date'])
                ->make(true);
        }
        $courses = Course::all();
        $subjects = Subject::all();
        $classes = ClassList::all();
        $course_type = CourseType::where("is_delivery_mode", 0)->get();
        $delivery_modes = CourseType::where("is_delivery_mode", 1)->get();
        $learners = User::where('role', 'Student')->get();
        $instructors = User::where('role', 'Teacher')->get();
        return view('admin.report.total_enrollment_report', compact('courses', 'subjects', 'classes', 'course_type', 'delivery_modes', 'instructors', 'learners'));
    }

    public function certificateReport(Request $request)
    {
        if ($request->ajax()) {
            $query = Certificate::select('courses.*', 'certificates.*', 'users.firstname as firstname', 'certificates.created_at as generated_date', 'curriculam_lectures.teacher_id as course_teacher')
            ->leftJoin('courses', 'courses.id', '=', 'certificates.course_id')
            ->leftJoin('curriculam_lectures', 'curriculam_lectures.course_id', '=', 'courses.id')
            ->leftJoin('users', 'users.id', '=', 'certificates.student_id');

            if (!empty($request->from_date) && !empty($request->to_date)) {
                $query->whereBetween(DB::raw('DATE(certificates.created_at)'), [$request->from_date, $request->to_date]);
            }

            if (!empty($request->class)) {
                $query->where('courses.class_id', $request->class);
            }

            if (!empty($request->subject)) {
                $query->where('courses.subject_id', $request->subject);
            }

            if (!empty($request->course)) {
                $query->where('courses.id', $request->course);
            }

            if (!empty($request->course_type)) {
                $query->where('courses.course_type_id', $request->course_type);
            }

            if (!empty($request->delivery_mode)) {
                $query->where('courses.delivery_mode_id', $request->delivery_mode);
            }

            if (!empty($request->instructor)) {
                $query->where('curriculam_lectures.teacher_id', $request->instructor);
            }

            if (!empty($request->learners)) {
                $query->where('certificates.student_id', $request->learners);
            }

            $data = $query->get();

            return Datatables::of($data)->addIndexColumn()
            ->addColumn('course_name', function ($row) {
                $course_name = $row->course ? $row->course->name : '';
                return $course_name;
            })
            ->addColumn('generated_date', function ($row) {
                return $row->generated_date;
            })
                ->rawColumns(['action'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $courses = Course::all();
        $subjects = Subject::all();
        $classes = ClassList::all();
        $delivery_modes = CourseType::where("is_delivery_mode", 1)->get();
        $instructors = User::where('role', 'Teacher')->get();
        $course_type = CourseType::where("is_delivery_mode", 0)->get();
        $learners = User::where('role', 'Student')->get();
        return view('admin.report.certificate_report', compact('courses', 'subjects', 'classes', 'course_type', 'delivery_modes', 'instructors', 'learners'));
    }
}
