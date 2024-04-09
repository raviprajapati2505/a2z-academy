<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage Teacher";
        $this->urlSlugs = "manage_teacher";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'Teacher')->get();
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
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-teacher" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-teacher" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
                    return $btn;
                })
                ->addColumn('class', function ($row) {
                    $class = $row->class ? $row->class->name : '';
                    return $class;
                })
                ->addColumn('subject', function ($row) {
                    $subject = $row->subject ? $row->subject->title : '';
                    return $subject;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $classes = ClassList::all();
        $subjects = Subject::all();
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes', 'subjects'));
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
            if ($request->teacher_id) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($request->teacher_id),
                    'username' => 'required|' . Rule::unique('users', 'username')->ignore($request->teacher_id),
                    'contact' => 'required|numeric|digits:10',
                    'teacher_class' => 'required',
                    'teacher_subject' => 'required'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required|unique:users,username|min:5|max:15',
                    'contact' => 'required|numeric|digits:10',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|same:password',
                    'teacher_class' => 'required',
                    'teacher_subject' => 'required'
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
                    'class_id' => $request->teacher_class,
                    'subject_id' => $request->teacher_subject,
                    'role' => 'Teacher'
                ];
                if ($request->teacher_id && empty($request->password)) {
                    unset($data['password']);
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
                        'message' => $request->teacher_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher  = User::find($id);

        return response()->json([
            'data' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $teacher)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = User::find($id);

        $teacher->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
