<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseType;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class PromocodeController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "PromoCode List";
		$this->urlSlugs = "promocode";
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = PromoCode::all();
			return Datatables::of($data)->addIndexColumn()
				->addColumn('action', function ($row) {
					$btn = '<a href="javascript:void(0);" class="edit-tbl edit-promocode" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-promocode" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
        $course_type = CourseType::where("is_delivery_mode", 0)->get();
		return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'course_type'));
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
				'code' => 'required',
				'discount_amount' => 'required',
				'valid_till' => 'required'
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
				'code' => $request->code,
				'discount_amount' => $request->discount_amount,
				'discount_type' => $request->discount_type,
				'valid_till' => $request->valid_till,
                'course_type_id' => $request->type,
			];
			PromoCode::updateOrCreate(
				[
					'id' => $request->promocode_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => $request->promocode_id ? 'Data updated successfully' : 'Data inserted successfully'
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
	 * @param  \App\Models\PromoCode  $promocode
	 * @return \Illuminate\Http\Response
	 */
	public function show(PromoCode $promocode)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\PromoCode  $promocode
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$promocode  = PromoCode::find($id);

		return response()->json([
			'data' => $promocode
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\PromoCode  $promocode
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, PromoCode $promocode)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\PromoCode  $promocode
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$promocode = PromoCode::find($id);

        $promocode->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
	}
}
