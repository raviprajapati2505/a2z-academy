<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TwoFAController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookStoreController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ClassListController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseCurriculamController;
use App\Http\Controllers\Admin\CourseQuizController;
use App\Http\Controllers\Admin\CourseTypeController;
use App\Http\Controllers\Admin\CurriculamLectureController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\NewnessClassController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentAssessmetController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentGradeController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Frontend\BookController;
use App\Http\Controllers\Frontend\CertificateController;
use App\Http\Controllers\Frontend\ClassesController;
use App\Http\Controllers\Frontend\CommonPagesController;
use App\Http\Controllers\Frontend\CoursesController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Teacher\EventController as TEventController;
use App\Http\Controllers\Teacher\StudentGradeController as TStudentGradeController;
use App\Http\Controllers\Teacher\StudentAssessmetController as TStudentAssessmetController;
use App\Http\Controllers\Teacher\NewnessClassController as TNewnessClassController;
use App\Http\Controllers\Teacher\ProfileController as TProfileController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\LiveClassController;
use App\Http\Controllers\Teacher\NoteController;

use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController as SProfileController;
use App\Http\Controllers\Frontend\EventController as SEventController;
use App\Http\Controllers\Frontend\DashboardController as SDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Auth::routes(['verify' => true]);

/* Route::get('/', function () {
    return view('auth.login');
}); */
Route::get('/', [MainController::class, 'index']);
Route::get('/pages/{slug}', CommonPagesController::class);
Route::get('/book_store', [BookController::class, 'book_store']);
Route::get('/course_by_class/{id}', [CoursesController::class, 'course_by_class']);
Route::get('/course_by_type/{id}', [CoursesController::class, 'course_by_type']);
Route::post('filter_course_by_class', [MainController::class, 'filter_course_by_class'])->name('filter_course_by_class');

Route::middleware(['auth', '2fa', 'student'])->group(function () {
    Route::get('/my_account', [SProfileController::class, 'index']);
    Route::get('/change_password', [SProfileController::class, 'change_password']);
    Route::get('/payment_history', [PaymentController::class, 'payment_history']);
    Route::get('/manage_payment', [PaymentController::class, 'manage_payment'])->name('manage_payment');
    Route::get('/manage_payment/{id}', [PaymentController::class, 'manage_payment']);
    Route::get('/course_detail/{id}', [CoursesController::class, 'course_detail']);
    Route::get('/lecture_player/{id}/{lecture_id}', [CoursesController::class, 'lecture_player']);
    Route::get('/purchased_courses', [CoursesController::class, 'purchased_courses']);
    Route::get('/video_classes', [ClassesController::class, 'video_classes']);
    Route::get('/certificate', [CertificateController::class, 'index']);
    Route::get('/certificate/{id}', [CertificateController::class, 'index']);

    Route::post('submit_change_password', [SProfileController::class, 'submit_change_password'])->name('submit_change_password');
    Route::post('submit_change_profile', [SProfileController::class, 'submit_change_profile'])->name('submit_change_profile');
    Route::get('remove_course_enroll/{id}', [PaymentController::class, 'remove_course_enroll'])->name('remove_course_enroll');
    Route::post('submit_student_review', [FeedbackController::class, 'submit_student_review'])->name('submit_student_review');
    Route::get('pay_for_courses', [PaymentController::class, 'pay_for_courses'])->name('pay_for_courses');
    Route::post('mark_as_favourite', [FeedbackController::class, 'mark_as_favourite'])->name('mark_as_favourite');
    Route::post('apply_promo', [FeedbackController::class, 'apply_promo'])->name('apply_promo');
    Route::post('track_lecture', [CoursesController::class, 'track_lecture'])->name('track_lecture');
    Route::post('download_certificate', [CertificateController::class, 'download_certificate'])->name('download_certificate');
    Route::get('/meeting', [ClassesController::class, 'meeting']);
    Route::get('/events', [SEventController::class, 'events']);
    Route::get('/dashboard', [SDashboardController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('2fa', [TwoFAController::class, 'index'])->name('2fa.index');
    Route::post('2fa', [TwoFAController::class, 'store'])->name('2fa.post');
    Route::get('2fa/reset', [TwoFAController::class, 'resend'])->name('2fa.resend');
});

Route::middleware(['auth', '2fa', 'admin'])->prefix('admin')->group(function () {
    Route::resource('manage_class', NewnessClassController::class);
    Route::resource('manage_admin', AdminController::class);
    Route::resource('manage_teacher', TeacherController::class);
    Route::resource('manage_student', StudentController::class);
    Route::resource('manage_course', CourseController::class);
    Route::resource('event', EventController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('grade', StudentGradeController::class);
    Route::resource('assessment', StudentAssessmetController::class);
    Route::resource('book_store', BookStoreController::class);
    Route::resource('course_type', CourseTypeController::class);
    Route::resource('class_list', ClassListController::class);
    Route::resource('page', PageController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('child_category', ChildCategoryController::class);
    Route::resource('promocode', PromoCodeController::class);

    Route::get('courses_curriculam/{cid}', [CourseCurriculamController::class, 'index']);
    Route::resource('course_curriculam', CourseCurriculamController::class);

    Route::get('courses_quiz/{cid}', [CourseQuizController::class, 'index']);
    Route::resource('courses_quiz', CourseQuizController::class);

    Route::get('curriculam_lectures/{cur_id}', [CurriculamLectureController::class, 'index']);
    Route::resource('curriculam_lecture', CurriculamLectureController::class);

    Route::get('report/total_enrollment_report', [ReportController::class, 'totalEnrollmentReport']);
    Route::get('report/certificate_report', [ReportController::class, 'certificateReport']);
    Route::get('admin_dashboard', [AdminDashboardController::class, 'index']);
    Route::get('revenue_chart', [AdminDashboardController::class, 'getRevenueChartData']);
});

Route::middleware(['auth', '2fa', 'teacher'])->prefix('teacher')->group(function () {
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::resource('manage_classes', TNewnessClassController::class);
    Route::resource('live_classes', LiveClassController::class);
    Route::resource('events', TEventController::class);
    Route::resource('profiles', TProfileController::class);
    Route::resource('grades', TStudentGradeController::class);
    Route::resource('assessments', TStudentAssessmetController::class);
    Route::resource('notes', NoteController::class);

    Route::get('meeting', [LiveClassController::class, 'meeting']);
});
Route::get('readnotification/{id}', [EventController::class, 'readnotification']);
Route::get('logout', function () {
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');
