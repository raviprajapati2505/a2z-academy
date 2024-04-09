<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage Admin";
        $this->urlSlugs = "manage_admin";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::where('role', 'Admin');
            $name = (!empty($_GET["search_name"])) ? ($_GET["search_name"]) : ('');
            if ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            }
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == "Enabled") {
                        $btn = '<span class="badge bg-primary">Active</span>';
                    } else {
                        $btn = '<span class="badge bg-danger">Inactive</span>';
                    }

                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-admin" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-admin" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
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
            if ($request->admin_id) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($request->admin_id),
                    'username' => 'required|' . Rule::unique('users', 'username')->ignore($request->admin_id),
                    'contact' => 'required|numeric|digits:10'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required|unique:users,username|min:5|max:15',
                    'contact' => 'required|numeric|digits:10',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|same:password',
                ]);
            }


            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'data' => $validator->errors(),
                        'message' => 'Error validation'
                    ]
                );
            }
            if (Hash::check($request->current_user_password, Auth::user()->password)) {
                $data = [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->contact,
                    'password' => Hash::make($request->password),
                    'status' => $request->status,
                    'role' => 'Admin'
                ];
                if ($request->admin_id && empty($request->password)) {
                    unset($data['password']);
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
                        'message' => $request->admin_id ? 'Data updated successfully' : 'Data inserted successfully'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Authentication failed, Please enter correct user identity'
                    ]
                );
            }
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
