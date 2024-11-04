<?php

namespace App\Providers;

use App\Models\ClassList;
use App\Models\CourseType;
use App\Models\NewnessClass;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'teacher.right_sidebar',
            function ($view) {
                $view->with('upcoming_class', NewnessClass::where('is_live', '0')->where('teacher_id', Auth::user()->id)->where('date', '>', Carbon::today())->skip(0)->take(3)->get());
                $view->with('notes', Note::where('teacher_id', Auth::user()->id)->orderby('id', 'desc')->skip(0)->take(3)->get());
                $view->with('subjects', Subject::all());
                ;
            }
        );

        view()->composer(
            'common.frontend.header',
            function ($view) {
                $view->with('course_types', CourseType::all());
                $view->with('classes', ClassList::all());
                $notifications = Auth::check() ? Notification::select('notifications.id as nid','events.*')->leftJoin('events', 'notifications.event_id', '=', 'events.id')->where('notifications.user_id', Auth::user()->id)->where('is_read', '0')->get() : collect();
                $view->with('notifications', $notifications);
            }
        );

        view()->composer('common.admin.navigation', function ($view) {
            $notifications = Auth::check() ? Notification::select('notifications.id as nid','events.*')->leftJoin('events', 'notifications.event_id', '=', 'events.id')->where('notifications.user_id', Auth::user()->id)->where('is_read', '0')->get() : collect();
            $view->with('notifications', $notifications);
        });
    }
}
