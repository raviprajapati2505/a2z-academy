<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewnessClassStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function video_classes(Request $request)
    {
        $query = NewnessClassStudent::with('newness_class')->whereHas('newness_class', function ($q) use ($request) {
            $q->where('is_live', '1');
        });
        $query->where('student_id', Auth::user()->id);
        $video_classes = $query->get();
        return view('frontend.class.video_classes', compact('video_classes'));
    }

    public function meeting(Request $request)
    {
        return view('frontend.class.meeting');
    }
}
