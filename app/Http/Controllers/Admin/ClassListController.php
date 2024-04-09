<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassList;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClassListController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Class List";
		$this->urlSlugs = "class_list";
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = ClassList::all();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '<a href="javascript:void(0);" class="edit-tbl edit-class-list" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-class-list" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title'));
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
				'name' => 'required'
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
				'name' => $request->name
			];
			ClassList::updateOrCreate(
				[
					'id' => $request->class_list_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->class_list_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\ClassList  $couse_type
	 * @return \Illuminate\Http\Response
	 */
	public function show(ClassList $couse_type)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\ClassList  $couse_type
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$couse_type  = ClassList::find($id);

		return response()->json([
			'data' => $couse_type
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\ClassList  $couse_type
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ClassList $couse_type)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\ClassList  $couse_type
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$class_list = ClassList::find($id);

        $class_list->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
	}
}
