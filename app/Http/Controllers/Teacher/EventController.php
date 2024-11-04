<?php

namespace App\Http\Controllers\Teacher;

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

	public function index()
	{
		$events = Event::select(array('datetime', 'description', 'type'))
			->whereNull('user_id')
			->orWhere('user_id', '=', Auth::user()->id)
			->get();
		$classes = NewnessClass::select(array('date', 'description', 'time_from', 'time_to'))->where('is_live', '1')->where('teacher_id', Auth::user()->id)->get();
		$urlSlug = $this->urlSlugs;
		$title = $this->titles;
		return view('teacher.' . $urlSlug . '.index', compact('urlSlug', 'title', 'events', 'classes'));
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
				'user_id' => Auth::user()->id,
				'created_by' => Auth::user()->id
			];
			Event::updateOrCreate(
				[
					'id' => $request->event_id
				],
				$data
			);

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
}
