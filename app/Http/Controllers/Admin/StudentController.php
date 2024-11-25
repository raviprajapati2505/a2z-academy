<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ClassList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\StudentCourseHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image as Image;

class StudentController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage Learner";
        $this->urlSlugs = "manage_student";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'Student')->get();
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
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-student" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-student" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>
                        
                        <a href="' . url('') . '/admin/manage_student/' . $row->id . '/certificate" title="certificate" class="delete-tbl" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Certificates</span>
                        </a>
                        ';
                    return $btn;
                })
                ->addColumn('class', function ($row) {
                    $class = $row->class ? $row->class->name : '';
                    return $class;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $classes = ClassList::all();
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->student_id) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($request->student_id),
                    'username' => 'required|' . Rule::unique('users', 'username')->ignore($request->student_id),
                    'contact' => 'required|numeric|digits:10',
                    'student_class' => 'required'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required|unique:users,username|min:5|max:15',
                    'contact' => 'required|numeric|digits:10',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|same:password',
                    'student_class' => 'required'
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
                    'class_id' => $request->student_class,
                    'external_id' => $request->external_id
                ];
                if ($request->student_id && empty($request->password)) {
                    unset($data['password']);
                }
                User::updateOrCreate(
                    [
                        'id' => $request->student_id
                    ],
                    $data
                );

                return response()->json(
                    [
                        'success' => true,
                        'message' => $request->student_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student  = User::find($id);

        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student) {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = User::find($id);

        $student->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function certificate($id)
    {
        $urlSlug = $this->urlSlugs;
        $title = 'Generate Certificate';
        $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', $id)
            ->where('student_course_history.is_paid', '1')
            ->get();
        $user = User::where('id', $id)->first();
        return view('admin.' . $urlSlug . '.certificate', compact('title', 'purchased_course', 'user'));
    }

    public function save_certificate(Request $request, $id)
    {
        // create Image from file
        $img = Image::make('public/frontend/images/certificates-img1.png');
        $image_profile = '';

        $image = $request->file('file');
        //$input['file'] = time().'.'.$image->getClientOriginalExtension();
        if (!empty($image)) {
            $imgFile = Image::make($image->getRealPath());
            $image_profile = $imgFile->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->insert($image_profile, 'top-left', 90, 150);
        }

        // use callback to define details
        $img->text($request->name, 420, 280, function ($font) {
            $font->file(realpath('public/fonts/Gilroy-Bold.ttf'));
            $font->size(45);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        
        $filename = $id . '-' . $request->course_id . '-certificate.png';
        $img->save('public/certificates/' . $filename);
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ];
        $data = [
            'file' => $filename,
            'year' => $request->year ?? '',
            'qualification' => $request->qualification ?? '',
            'organization' => $request->organization ?? '',
            'reference_number' => $request->reference_number ?? '',
            'expiry_date' => $request->expiry_date ?? '',
            'course_id' => $request->course_id,
            'name' => $request->name ?? '',
        ];
        if ($request->admin_id && empty($request->password)) {
            unset($data['password']);
        }

        Certificate::updateOrCreate(
            [
                'student_id' => $id,
                'course_id' => $request->course_id
            ],
            $data
        );
        return response()->stream(function () use ($img) {
            echo $img;
        }, 200, $headers);
    }
}
