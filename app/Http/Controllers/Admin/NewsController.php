<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CommonHelper as Helper;
use App\Models\News;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage News";
        $this->urlSlugs = "news";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = News::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('description', function ($row) {
                    return substr($row->description, 0, 50);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == "Enabled") {
                        $btn = '<span class="badge bg-primary">Active</span>';
                    } else {
                        $btn = '<span class="badge bg-danger">Inactive</span>';
                    }

                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-news" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-news" data-id=' . $row->id . '">
                            <img src="' . asset("public/images/delete-icon.png") . '" alt=""> <span>Delete</span>
                        </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $classes = ClassList::all();
        $subjects = Subject::all();
        $teachers = User::where('role', 'Teacher')->get();
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'classes', 'subjects', 'teachers'));
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
                'title' => 'required|min:1|max:100',
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
                'description' => $request->description
            ];

            if ($request->hasFile('image')) {
                $data['image'] = Helper::uploadDocuments($request, 'image', 'uploads/news/images');
            }
            News::updateOrCreate(
                [
                    'id' => $request->news_id
                ],
                $data
            );

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->news_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news  = News::find($id);

        return response()->json([
            'data' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        $news->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
