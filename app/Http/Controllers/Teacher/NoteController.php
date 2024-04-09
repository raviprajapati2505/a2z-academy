<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NoteController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "My Notes";
		$this->urlSlugs = "notes";
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Note::where('teacher_id', Auth::user()->id)->get();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '<a href="javascript:void(0);" class="edit-tbl edit-note" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-note" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title'));
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
				'description' => 'required'
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
				'description' => $request->description,
				'teacher_id' => Auth::user()->id
			];
			Note::updateOrCreate(
				[
					'id' => $request->note_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->note_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function show(Note $note)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$note  = Note::find($id);

		return response()->json([
			'data' => $note
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Note $note)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$page = Note::find($id);

		$page->delete();

		return response()->json([
			'message' => 'Data deleted successfully!'
		]);
	}
}
