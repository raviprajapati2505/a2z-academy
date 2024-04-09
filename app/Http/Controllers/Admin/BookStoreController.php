<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CommonHelper as Helper;
use App\Models\Book;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassList;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BookStoreController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Manage Books";
        $this->urlSlugs = "book_store";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::all();
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
                    $btn = '<a href="javascript:void(0);" class="edit-tbl edit-book" data-id=' . $row->id . '">
                        <img src="' . asset("public/images/edit-icon.png") . '" alt=""> <span>Edit</span>
                    </a>

                        <a href="javascript:void(0);" title="delete" class="delete-tbl delete-book" data-id=' . $row->id . '">
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
                'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                'author' => 'required',
                'cover_image' => 'mimes:png,jpg,jpeg',
                'book_file' => 'mimes:pdf,dox,ppt,pptx,xls'
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
                'external_link' => $request->external_link,
                'author' => $request->author,
                'status' => $request->status,
            ];

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = Helper::uploadDocuments($request, 'cover_image', 'uploads/books/images');
            }
            if ($request->hasFile('book_file')) {
                $data['book_file'] = Helper::uploadDocuments($request, 'book_file', 'uploads/books/files');
            }
            Book::updateOrCreate(
                [
                    'id' => $request->book_id
                ],
                $data
            );

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->book_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book  = Book::find($id);

        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
