<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseCurriculam;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourseCurriculamController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Course Curriculam";
		$this->urlSlugs = "course_curriculam";
	}

	public function index(Request $request, $id = '')
	{
		if ($request->ajax()) {
			$data = CourseCurriculam::where('course_id', request()->course_id)->get();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '
					<a href="' . url('admin/curriculam_lectures/') . '/' . $row->id . '" class="edit-tbl">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Lectures</span>
                    </a>
					
					<a href="javascript:void(0);" class="edit-tbl edit-course-curriculam" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

					<a href="javascript:void(0);" title="delete" class="delete-tbl delete-course-curriculam" data-id=' . $row->id . '">
						<img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
					</a>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		$course = Course::where('id', $id)->first();
		return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'course'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'title' => 'required',
				'status' => 'required'
			]);

			if ($validator->fails()) {
				return response()->json(
					[
						'success' => false,
						'data' => $validator->errors(),
						'message' => 'Error validation'
					]
				);
			}
			$data = [
				'title' => $request->title,
				'status' => $request->status,
				'display_order' => $request->display_order,
				'course_id' => $request->course_id
			];
			CourseCurriculam::updateOrCreate(
				[
					'id' => $request->course_curriculam_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->course_curriculam_id ? 'Data updated successfully' : 'Data inserted successfully'
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

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\CourseCurriculam  $course_curriculam
	 * @return \Illuminate\Http\Response
	 */
	public function show(CourseCurriculam $course_curriculam)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\CourseCurriculam $course_curriculam
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$course_curriculam  = CourseCurriculam::find($id);

		return response()->json([
			'data' => $course_curriculam
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\CourseCurriculam  $course_curriculam
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, CourseCurriculam $course_curriculam)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\CourseCurriculam  $course_curriculam
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$course_curriculam = CourseCurriculam::find($id);

		$course_curriculam->delete();

		return response()->json([
			'message' => 'Data deleted successfully!'
		]);
	}
}
