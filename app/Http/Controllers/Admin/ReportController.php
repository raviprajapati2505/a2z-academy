<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\CourseType;
use App\Models\StudentCourseHistory;
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

	public function __construct()
	{
	}

	public function totalEnrollmentReport(Request $request)
	{
		if ($request->ajax()) {
			$query = StudentCourseHistory::select('courses.*', 'student_course_history.*', 'users.firstname as firstname', 'student_course_history.created_at as purchased_date')->leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')->leftJoin('users', 'users.id', '=', 'student_course_history.student_id')
				->where('student_course_history.is_paid', '1');

			if(!empty($request->from_date) && !empty($request->to_date)){
				$query->whereBetween(DB::raw('DATE(student_course_history.created_at)'), [$request->from_date, $request->to_date]);
			}

			$data = $query->get();

			return Datatables::of($data)->addIndexColumn()->addColumn('purchased_date', function ($row) {
				return $row->purchased_date;
			})
				->rawColumns(['purchased_date'])
				->make(true);
		}
		return view('admin.report.total_enrollment_report');
	}

	public function certificateReport(Request $request)
	{
		if ($request->ajax()) {
			$query = Certificate::select('courses.*', 'certificates.*', 'users.firstname as firstname', 'certificates.created_at as generated_date')->leftJoin('courses', 'courses.id', '=', 'certificates.course_id')->leftJoin('users', 'users.id', '=', 'certificates.student_id');

			if(!empty($request->from_date) && !empty($request->to_date)){
				$query->whereBetween(DB::raw('DATE(certificates.created_at)'), [$request->from_date, $request->to_date]);
			}

			$data = $query->get();

			return Datatables::of($data)->addIndexColumn()->addColumn('generated_date', function ($row) {
				return $row->generated_date;
			})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		return view('admin.report.certificate_report');
	}
}
