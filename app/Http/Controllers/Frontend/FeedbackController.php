<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\StudentReview;
use App\Models\StudentFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function submit_student_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback_text' => 'required',
            'star_rating' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $review = new StudentReview();
        $review->student_id = Auth::user()->id;
        $review->course_id = $request->course_id;
        $review->feedback_text = $request->feedback_text;
        $review->star_rating = $request->star_rating;
        $review->save();

        if ($review) {
            return back()->with('success', 'Thank you !! feedback save successfully');
        }
    }

    public function mark_as_favourite(Request $request)
    {
        try {
            $already = StudentFavourite::where('student_id', Auth::user()->id)->where('course_id', $request->course_id)->get();
            if (count($already) <= 0) {
                $favourite = new StudentFavourite();
                $favourite->student_id = Auth::user()->id;
                $favourite->course_id = $request->course_id;
                $favourite->save();
            }else{
              $already[0]->delete();
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Marked as favourite'
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

    public function apply_promo(Request $request)
    {
        try {
            $check_valid_code = PromoCode::where('code', $request->code)->where('valid_till', '>', Carbon::today())->get();
            if (count($check_valid_code) <= 0) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Invalid promo code'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'success' => true,
                        'data' => $check_valid_code,
                        'message' => 'Promo code applied'
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
