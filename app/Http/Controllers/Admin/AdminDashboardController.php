<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentCourseHistory;
use App\Models\StudentReview;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Admin Dashboard";
        $this->urlSlugs = "admin_dashboard";
    }

    public function index(Request $request)
    {
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        $studentsCount = User::where('role', 'teacher')->count();
        $teachersCount = User::where('role', 'student')->count();
        $activeCourses = Course::where('status', 'Enabled')->count();
        $enrolledCourses = StudentCourseHistory::distinct()->count('course_id');
        $freeCourses = Course::where('is_paid', '0')->count();
        $paidCourses = Course::where('status', '1')->count();
        $totalEarning = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.is_paid', '1')
            ->select('courses.id', DB::raw('SUM(courses.price) as total_price'))
            ->groupBy('courses.id')
            ->get();
        $totalEarning = !empty($totalEarning) ? $totalEarning->sum('total_price') : 0;
        $ratingsCounts = DB::table(DB::raw('(SELECT 1 AS star_rating UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) as all_ratings'))
            ->leftJoin('student_reviews', 'all_ratings.star_rating', '=', 'student_reviews.star_rating')
            ->select('all_ratings.star_rating', DB::raw('COUNT(student_reviews.star_rating) as count'))
            ->groupBy('all_ratings.star_rating')
            ->orderBy('all_ratings.star_rating')
            ->get();
        $totalReviewCount = StudentReview::count();
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'studentsCount', 'teachersCount', 'activeCourses', 'enrolledCourses', 'freeCourses', 'paidCourses', 'totalEarning', 'totalReviewCount', 'ratingsCounts'));
    }

    public function getRevenueChartData()
    {
        $weeklyRevenue = DB::table('student_reviews')
            ->selectRaw('YEARWEEK(student_reviews.created_at) as week, SUM(courses.price) as total')
            ->leftJoin('courses', 'student_reviews.course_id', '=', 'courses.id')
            ->groupBy('week')
            ->get();

        $monthlyRevenue = DB::table('student_reviews')
            ->selectRaw('DATE_FORMAT(student_reviews.created_at, "%Y-%m") as month, SUM(courses.price) as total')
            ->leftJoin('courses', 'student_reviews.course_id', '=', 'courses.id')
            ->whereRaw('student_reviews.created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->groupBy('month')
            ->get();

        return response()->json([
            'weekly' => $weeklyRevenue,
            'monthly' => $monthlyRevenue
        ]);
    }
}
