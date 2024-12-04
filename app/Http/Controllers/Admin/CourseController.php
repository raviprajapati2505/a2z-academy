<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CommonHelper as Helper;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ClassList;
use App\Models\CourseMaterial;
use App\Models\CourseType;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage Course";
        $this->urlSlugs = "manage_course";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::all();
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
                    $btn = '

                    <a href="' . url('admin/courses_quiz/') . '/' . $row->id . '" class="edit-tbl">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Quiz</span>
                    </a>

                    <a href="' . url('admin/courses_curriculam/') . '/' . $row->id . '" class="edit-tbl">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Curriculams</span>
                    </a>

                    <a href="javascript:void(0);" class="edit-tbl edit-course" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                    <a href="javascript:void(0);" title="delete" class="delete-tbl delete-course" data-id=' . $row->id . '">
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
        $course_type = CourseType::where("is_delivery_mode", 0)->get();
        $delivery_modes = CourseType::where("is_delivery_mode", 1)->get();
        $child_category = ChildCategory::all();
        $teachers = User::where('role', 'Teacher')->get();
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes', 'subjects', 'teachers', 'course_type', 'child_category', 'delivery_modes'));
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
                'name' => 'required|min:1|max:200',
                'course_class' => 'required',
                'course_subject' => 'required',
                //'teacher' => 'required',
                'cover_image' => 'mimes:png,jpg,jpeg',
                'video' => 'mimes:mov,mp4,mkv,flv,avi',
                'description' => 'required'
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
                'description' => $request->description,
                'course_type_id' => $request->type,
                'is_paid' => $request->is_paid,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'language' => $request->language,
                'link' => $request->link,
                'status' => $request->status,
                'class_id' => $request->course_class,
                'subject_id' => $request->course_subject,
                'teacher_id' => $request->teacher,
                'created_by' => Auth::user()->id,
                'short_description' => $request->short_description,
                'what_you_learn' => $request->what_you_learn,
                'instructor_infromation' => $request->instructor_infromation,
                'ceu_points' => $request->ceu_points,
                'child_category_id' => $request->child_category,
                'delivery_mode_id' => $request->delivery_mode
            ];

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = Helper::uploadDocuments($request, 'cover_image', 'uploads/courses/images');
            }
            if ($request->hasFile('video')) {
                $data['video'] = Helper::uploadDocuments($request, 'video', 'uploads/courses/videos');
            }

            Course::updateOrCreate(
                [
                    'id' => $request->course_id
                ],
                $data
            );
            
            $oldCourseMaterial = CourseMaterial::where('course_id', $request->course_id)->delete();

            if ($request->hasfile('materials')) {
                foreach ($request->file('materials') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/courses/materials/', $name);

                    $courseMaterial = new CourseMaterial();
                    $courseMaterial->course_id = $request->course_id;
                    $courseMaterial->file = 'uploads/courses/materials/' . $name;
                    $courseMaterial->save();
                }
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->course_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course  = Course::find($id);

        return response()->json([
            'data' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        $course->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
