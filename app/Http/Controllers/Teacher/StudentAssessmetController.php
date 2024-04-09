<?php

namespace App\Http\Controllers\Teacher;

use App\Helper\CommonHelper as Helper;
use App\Models\User;
use App\Models\ClassList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentAssessment;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class StudentAssessmetController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Student Assessment";
        $this->urlSlugs = "assessments";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentAssessment::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('marks', function ($row) {
                    $btn = '<span class="badge bg-primary">' . $row->marks . ' / 100</span>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-assessment" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-assessment" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
                    return $btn;
                })
                ->addColumn('subject', function ($row) {
                    $subject = $row->subject ? $row->subject->title : '';
                    return $subject;
                })
                ->addColumn('class', function ($row) {
                    $class = $row->class ? $row->class->name : '';
                    return $class;
                })
                ->addColumn('student', function ($row) {
                    $student = $row->student ? $row->student->name : '';
                    return $student;
                })
                ->rawColumns(['action', 'marks'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $subjects = Subject::all();
        $classes = ClassList::all();
        $students = User::where('role', 'Student')->get();
        return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'subjects', 'classes', 'students'));
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
                'assessment_subject' => 'required',
                'assessment_class' => 'required',
                'marks' => 'required',
                'assesment_file' => 'mimes:png,pdf,jpg,jpeg,docx',
                'started_date' => 'required',
                'expired_date' => 'required',
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
                'marks' => $request->marks,
                'class_id' => $request->assessment_class,
                'subject_id' => $request->assessment_subject,
                'student_id' => $request->student,
                'created_by' => Auth::user()->id,
                'other_info' => $request->other_info,
                'expired_date' => $request->expired_date,
                'started_date' => $request->started_date,
            ];
            if ($request->hasFile('assesment_file')) {
                $data['assesment_file'] = Helper::uploadDocuments($request, 'assesment_file', 'uploads/assessment/images');
            }
            StudentAssessment::updateOrCreate(
                [
                    'id' => $request->assessment_id
                ],
                $data
            );

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->assessment_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\StudentAssessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAssessment $assessment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAssessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student  = StudentAssessment::find($id);

        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAssessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAssessment $assessment)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAssessment  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = StudentAssessment::find($id);

        $student->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
