<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\ClassList;
use App\Models\StudentReview;
use App\Models\User;
use App\Models\CurriculamLecture;
use App\Models\NewnessClassStudent;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    public function index()
    {
        $course_types = CourseType::where("is_delivery_mode", 0)->orderby('title', 'asc')->get();
        $all_courses = Course::orderBy('created_at', 'desc')->get();
        $class_list = ClassList::all();
        $news = News::orderBy('created_at', 'desc')->get();
        $student_review = StudentReview::leftJoin('courses', 'courses.id', '=', 'student_reviews.course_id')->orderBy('student_reviews.created_at')->skip(0)->take(10)->get();

        $query = NewnessClassStudent::with('newness_class')->whereHas('newness_class', function ($q) {
            $q->where('is_live', '1');
        });
        if (Auth::user()) {
            $query->where('student_id', Auth::user()->id);
        }

        $newness_classes = $query->get();

        # for counts
        $all_review_count = StudentReview::count();
        $adviser_count = User::where('role', 'Teacher')->count();
        $video_tutorials_count = CurriculamLecture::count();
        return view('frontend.home', compact('all_courses', 'course_types', 'student_review', 'all_review_count', 'adviser_count', 'video_tutorials_count', 'newness_classes', 'class_list', 'news'));
    }

    public function filter_course_by_class(Request $request)
    {
        try {
            $courses = Course::where('course_type_id', $request->category_id)->get();
            if (count($courses) > 0) {
                return response()->json(
                    [
                        'success' => true,
                        'data' => $courses,
                        'message' => 'Courses found successfully'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Courses not found'
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
}
