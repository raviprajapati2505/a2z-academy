<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\NewnessClass;
use Carbon\Carbon;
trait UserTrait
{
    public function currentUser()
    {
        // Fetch all the students from the 'student' table.
        $user = Auth::User()->toArray();
        $user['current_grade'] = "";
        $user['image'] = asset('public/images/user-icon.png');
        $user['userEvents'] = $this->userEvents();
        $user['userVideoCourses'] = $this->userVideoCourses($user['id']);
        return $user;
    }
    public function userEvents()
    {
        // Fetch all the students from the 'student' table.
        $events = Event::select(array('datetime', 'description', 'type'))
			->whereNull('user_id')
			->orWhere('user_id', '=', Auth::user()->id)
            ->limit(3)
			->get();
        return $events;
    }
    public function userVideoCourses($userId)
    {
        // Fetch all the students from the 'student' table.
        $courses = NewnessClass::where('is_live', '1')->where('teacher_id', Auth::user()->id)->where('date', '>', Carbon::today())->skip(0)->take(3)->get();

        return $courses;
    }
}
