<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\NewnessClass;
use App\Models\Notification;
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
        $this->urlSlugs = "event";
    }

    public function index()
    {
        $events = Event::select(array('datetime', 'description', 'type'))->get();
        $classes = NewnessClass::select(array('date', 'description', 'time_from', 'time_to'))->where('is_live', '1')->get();
        $urlSlug = $this->urlSlugs;
        $title = $this->titles;
        return view('admin.' . $urlSlug . '.index', compact('urlSlug', 'title', 'events', 'classes'));
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
                'type' => 'required',
                'date' => 'required',
                'description' => 'required'
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
                'type' => $request->type,
                'datetime' => $request->date,
                'description' => $request->description,
                'created_by' => Auth::user()->id
            ];
            $event = Event::updateOrCreate(
                [
                    'id' => $request->event_id
                ],
                $data
            );

            $lastInsertId = $event->id;

            $users = User::all(); // Assuming you want to notify all users

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'event_id' => $lastInsertId
                ]);
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => $request->event_id ? 'Data updated successfully' : 'Data inserted successfully'
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event  = Event::find($id);

        return response()->json([
            'data' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function readnotification($notificationId){
        $notification = Notification::find($notificationId);
        $notification->is_read = true;
        $notification->save();

        if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin') {
            return redirect('/admin/event');
        } else if (Auth::user()->role == 'Credentials') {
            return redirect('/admin/event');
        } else if (Auth::user()->role == 'Teacher') {
            return redirect('/teacher/events');
        } else {
            return redirect('/events');
        }
    }
}
