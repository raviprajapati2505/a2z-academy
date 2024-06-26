<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseCurriculam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurriculamLecture;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\CommonHelper as Helper;

class CurriculamLectureController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Curriculam Lecture";
		$this->urlSlugs = "curriculam_lecture";
	}

	public function index(Request $request, $id = '')
	{
		if ($request->ajax()) {
			$data = CurriculamLecture::where('course_curriculam_id', request()->course_curriculam_id)->get();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '<a href="javascript:void(0);" class="edit-tbl edit-curriculam-lecture" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

					<a href="javascript:void(0);" title="delete" class="delete-tbl delete-curriculam-lecture" data-id=' . $row->id . '">
						<img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
					</a>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		$teachers = User::where('role', 'Teacher')->get();
		$course_curriculam = CourseCurriculam::where('id', $id)->get()[0];
		return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'teachers', 'course_curriculam'));
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
				'video' => 'mimes:mov,mp4,mkv,flv,avi',
				'description' => 'required',
				'duration_in_hour' => 'required',
				'status' => 'required',
				'teacher' => 'required'
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

			$course_curriculam = CourseCurriculam::where('id', $request->course_curriculam_id)->get()[0];
			$data = [
				'title' => $request->title,
				'status' => $request->status,
				'display_order' => $request->display_order,
				'description' => $request->description,
				'is_free' => $request->is_free,
				'duration_in_hour' => $request->duration_in_hour,
				'teacher_id' => $request->teacher,
				'course_id' => $course_curriculam->course_id,
				'course_curriculam_id' => $request->course_curriculam_id,
        'link' => $request->link
			];

			if ($request->hasFile('video')) {
				$data['video'] = Helper::uploadDocuments($request, 'video', 'uploads/curriculam_lectures/videos');
			}

			CurriculamLecture::updateOrCreate(
				[
					'id' => $request->curriculam_lecture_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->curriculam_lecture_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\CurriculamLecture  $curriculam_lecture
	 * @return \Illuminate\Http\Response
	 */
	public function show(CurriculamLecture $curriculam_lecture)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\CurriculamLecture $curriculam_lecture
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$curriculam_lecture  = CurriculamLecture::find($id);

		return response()->json([
			'data' => $curriculam_lecture
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\CurriculamLecture  $curriculam_lecture
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, CurriculamLecture $curriculam_lecture)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\CurriculamLecture  $curriculam_lecture
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$curriculam_lecture = CurriculamLecture::find($id);

		$curriculam_lecture->delete();

		return response()->json([
			'message' => 'Data deleted successfully!'
		]);
	}
}
