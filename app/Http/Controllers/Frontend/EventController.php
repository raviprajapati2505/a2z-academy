<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\NewnessClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    private $urlSlugs, $titles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->titles = "Calendar";
        $this->urlSlugs = "events";
    }

    public function events()
    {
        $events = Event::select(array('datetime', 'description', 'type'))
            ->whereNull('user_id')
            ->orWhere('user_id', '=', Auth::user()->id)
            ->get();
        $classes = NewnessClass::select(array('date', 'description', 'time_from', 'time_to'))->where('is_live', '1')->where('teacher_id', Auth::user()->id)->get();
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        return view('frontend.' . $urlSlug . '.index', compact('urlSlug', 'title', 'events', 'classes'));
    }
}
