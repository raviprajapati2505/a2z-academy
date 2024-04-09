<?php

namespace App\Http\Controllers\Teacher;

use App\Helper\CommonHelper as Helper;
use App\Models\NewnessClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NewnessClassController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "My Classes";
        $this->urlSlugs = "manage_classes";
    }

    public function index(Request $request)
    {
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $classes = ClassList::all();
        $subjects = Subject::all();
        $teachers = User::where('role', 'Teacher')->get();
        $students = User::where('role', 'Student')->get();
        $my_classes = NewnessClass::where('is_live', '0')->where('teacher_id', Auth::user()->id)->where('date', Carbon::today())->get();
        $last_week_class = NewnessClass::where('is_live', '0')->where('teacher_id', Auth::user()->id)->whereBetween(
            'date',
            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
        )->get();
        return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes', 'subjects', 'teachers', 'students', 'my_classes', 'last_week_class'));
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
                'status' => $request->status,
                'class_id' => $request->class_class,
                'subject_id' => $request->class_subject,
                'teacher_id' => Auth::user()->id,
                'created_by' => Auth::user()->id,
                'description' => $request->description ? $request->description : 'class information',
                'user_id' => Auth::user()->id
            ];
            if ($request->hasFile('image')) {
                $data['image'] = Helper::uploadDocuments($request, 'image', 'uploads/classes/images');
            }
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
}
