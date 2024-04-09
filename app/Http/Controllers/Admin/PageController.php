<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Content Page";
		$this->urlSlugs = "page";
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Page::all();
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
				'title' => 'required',
				'content' => 'required',
				'slug' => 'required'
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
				'content' => $request->content,
				'slug' => $request->slug
			];
			Page::updateOrCreate(
				[
					'id' => $request->page_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->page_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function show(Page $page)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$page  = Page::find($id);

		return response()->json([
			'data' => $page
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Page $page)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$page = Page::find($id);

        $page->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
	}
}
