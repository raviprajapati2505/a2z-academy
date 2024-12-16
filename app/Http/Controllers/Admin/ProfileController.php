<?php

namespace App\Http\Controllers\Admin;

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
		$this->urlSlugs = "profile";
	}

	public function index(Request $request)
	{
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		$user_id = Auth::user()->id;
		return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'user_id'));
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
				'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($request->admin_id)->whereNull('deleted_at'),
				'username' => 'required|' . Rule::unique('users', 'username')->ignore($request->admin_id)->whereNull('deleted_at'),
				'contact' => 'required|numeric|digits:10',
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
				'username' => $request->username,
				'email' => $request->email,
				'phone' => $request->contact,
				'password' => Hash::make($request->password),
				'country_code' => $request->country_code
			];
			if ($request->admin_id && empty($request->password)) {
				unset($data['password']);
			}
			if ($request->hasFile('photo')) {
				$data['photo'] = Helper::uploadDocuments($request, 'photo', 'uploads/profile/images');
			}
			User::updateOrCreate(
				[
					'id' => $request->admin_id
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
