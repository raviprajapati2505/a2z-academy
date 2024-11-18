<?php

namespace App\Http\Controllers\Teacher;

use App\Helper\CommonHelper as Helper;
use App\Models\NewnessClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ClassList;
use App\Models\CourseType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ZoomMeetingTrait;

class LiveClassController extends Controller
{
    use ZoomMeetingTrait;

    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Create Live Class";
        $this->urlSlugs = "live_classes";
    }

    public function index(Request $request)
    {
        /*if ($request->ajax()) {
            $data = NewnessClass::where('is_live', '1')->where('teacher_id', Auth::user()->id)->get();
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
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-class" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                    <a href="#" title="join meeting" class="join_meeting_old edit-class" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Join</span>
                    </a>

                    <a href="javascript:void(0);" title="delete" class="delete-tbl delete-class" data-id=' . $row->id . '">
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
        }*/
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $classes = ClassList::all();
        $subjects = Subject::all();
        $course_type = CourseType::where("is_delivery_mode", 0)->get();
        $child_category = ChildCategory::all();
        $teachers = User::where('role', 'Teacher')->get();
        $students = User::where('role', 'Student')->get();
        $live_class = NewnessClass::where('is_live', '1')->where('teacher_id', Auth::user()->id)->get();
        return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes', 'subjects', 'teachers', 'students', 'live_class', 'course_type', 'child_category'));
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
                'date' => 'required',
                'class_class' => 'required',
                'class_subject' => 'required',
                'image' => 'mimes:png,jpg,jpeg'
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
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'status' => 'Enabled',
                'class_id' => $request->class_class,
                'subject_id' => $request->class_subject,
                'teacher_id' => Auth::user()->id,
                'created_by' => Auth::user()->id,
                'description' => $request->description ? $request->description : 'Live class',
                'child_category_id' => $request->child_category,
                'course_type_id' => $request->type,
                'user_id' => Auth::user()->id,
                'is_live' => '1'
            ];
            if ($request->hasFile('image')) {
                $data['image'] = Helper::uploadDocuments($request, 'image', 'uploads/classes/images');
            }

            # create zoom meeting
            $zoom_data = array();
            $zoom_date = new Carbon('' . $request->date . ' ' . $request->time_from . ':00:00');
            $zoom_data['topic'] = 'Test';
            $zoom_data['agenda'] = 'Quick test agenda';
            $zoom_data['host_video'] = 1;
            $zoom_data['participant_video'] = 1;
            $zoom_data['duration'] = 10;
            $zoom_data['start_time'] = $zoom_date->toAtomString();
            $meeting = $this->zoom_create($zoom_data);

            $data['zoom_join_url'] = $meeting['data']['join_url'];
            $data['zoom_start_url'] = $meeting['data']['start_url'];

            $class = NewnessClass::updateOrCreate(
                [
                    'id' => $request->class_id
                ],
                $data
            );
            $class->students()->sync($request->students);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
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
     * @param  \App\Models\NewnessClass  $class
     * @return \Illuminate\Http\Response
     */
    public function show(NewnessClass $class)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewnessClass  $class
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class  = NewnessClass::with('students')->where('id', $id)->get()[0];

        return response()->json([
            'data' => $class
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewnessClass  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewnessClass $class)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewnessClass  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = NewnessClass::find($id);

        $class->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }

    public function meeting()
    {  
        $title = $this->titles = "Live Class"; 
        $urlSlug = $this->urlSlugs;
        return view('teacher.' . $urlSlug . '.meeting', compact('urlSlug','title'));
    }
}
