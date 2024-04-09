<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseQuiz;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourseQuizController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Course Quiz";
		$this->urlSlugs = "courses_quiz";
	}

	public function index(Request $request, $id = '')
	{
		if ($request->ajax()) {
			$data = CourseQuiz::where('video_course_id', request()->course_id)->get();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '
					<a href="javascript:void(0);" class="edit-tbl edit-courses-quiz" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

					<a href="javascript:void(0);" title="delete" class="delete-tbl delete-courses-quiz" data-id=' . $row->id . '">
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
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'correct_answer' => 'required',
                'sorting' => 'required',
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
				'question' => $request->question,
				'option_a' => $request->option_a,
				'option_b' => $request->option_b,
				'option_c' => $request->option_c,
				'option_d' => $request->option_d,
				'correct_answer' => $request->correct_answer,
				'sorting' => $request->sorting,
				'video_course_id' => $request->course_id
			];
			CourseQuiz::updateOrCreate(
				[
					'id' => $request->courses_quiz_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->courses_quiz_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\CourseQuiz  $courses_quiz
	 * @return \Illuminate\Http\Response
	 */
	public function show(CourseQuiz $courses_quiz)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\CourseQuiz $courses_quiz
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$courses_quiz  = CourseQuiz::find($id);

		return response()->json([
			'data' => $courses_quiz
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\CourseQuiz  $courses_quiz
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, CourseQuiz $courses_quiz)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\CourseQuiz  $courses_quiz
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$courses_quiz = CourseQuiz::find($id);

		$courses_quiz->delete();

		return response()->json([
			'message' => 'Data deleted successfully!'
		]);
	}
}
