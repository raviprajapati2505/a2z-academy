<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use App\Helper\CommonHelper as Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
	private $urlSlugs, $titles;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->titles = "Admin Profile";
		$this->urlSlugs = "profiles";
	}

	public function index(Request $request)
	{
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		$user_id = Auth::user()->id;
		return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'user_id'));
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
				'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
				'lastname' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
				'contact' => 'required|numeric',
				'photo' => 'mimes:png,jpg,jpeg'
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
				'name' => $request->name,
				'lastname' => $request->lastname,
				'education' => $request->education,
				'language' => $request->language,
				'gender' => $request->gender,
				'dob' => $request->dob,
				'availability' => $request->availability,
				'phone' => $request->contact,
				'years_experience' => $request->experience,
				'designation' => $request->designation,
				'present_address' => $request->present_address,
				'aboutme' => $request->aboutme,
				'permananat_address' => $request->permanant_address,
				'country_code' => $request->country_code
			];
			if ($request->teacher_id && empty($request->password)) {
				unset($data['password']);
			}
			if ($request->hasFile('photo')) {
				$data['photo'] = Helper::uploadDocuments($request, 'photo', 'uploads/profile/images');
			}
			User::updateOrCreate(
				[
					'id' => $request->teacher_id
				],
				$data
			);

			return response()->json(
				[
					'success' => true,
					'message' => 'Profile updated successfully'
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
	 * @param  \App\Models\User  $admin
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $admin)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $admin
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$admin  = User::find($id);

		return response()->json([
			'data' => $admin
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $admin
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $admin)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $admin
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$admin = User::find($id);

		$admin->delete();

		return response()->json([
			'message' => 'Data deleted successfully!'
		]);
	}
}
