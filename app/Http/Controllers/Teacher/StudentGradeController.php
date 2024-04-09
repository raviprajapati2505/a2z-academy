<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use App\Models\ClassList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


class StudentGradeController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Student Grade";
        $this->urlSlugs = "grades";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentGrade::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('grade', function ($row) {
                    $btn = '<span class="badge bg-primary">' . $row->grade . '</span>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-grade" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-grade" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
                    return $btn;
                })
                ->addColumn('subject', function ($row) {
                    $subject = $row->subject ? $row->subject->title : '';
                    return $subject;
                })
                ->addColumn('student', function ($row) {
                    $student = $row->student ? $row->student->name : '';
                    return $student;
                })
                ->rawColumns(['action', 'grade'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $subjects = Subject::all();
        $teachers = User::where('role', 'Teacher')->get();
        $students = User::where('role', 'Student')->get();
        return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'subjects', 'teachers', 'students'));
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
                'student' => 'required',
                'grade_subject' => 'required',
                'grade' => 'required',
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
                'grade' => $request->grade,
                'teacher_id' => Auth::user()->id,
                'subject_id' => $request->grade_subject,
                'student_id' => $request->student,
                'created_by' => Auth::user()->id
            ];
            StudentGrade::updateOrCreate(
                [
                    'id' => $request->grade_id
                ],
                $data
            );

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->grade_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\StudentGrade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(StudentGrade $grade)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentGrade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student  = StudentGrade::find($id);

        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentGrade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentGrade $grade)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentGrade  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = StudentGrade::find($id);

        $student->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
