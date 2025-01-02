<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\StudentCourseHistory;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment_history()
    {
        # if courses which is purchased by the student
        $purchased_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '1')
            ->get();
        return view('frontend.payment.payment_history', compact('purchased_course'));
    }

    public function manage_payment()
    {
        $is_enroll_course_id = request()->segment(2);
        # if course id exists enroll student in to the  course
        if ($is_enroll_course_id) {
            $is_already_enroll = StudentCourseHistory::where('course_id', $is_enroll_course_id)->where('student_id', Auth::user()->id)->get();
            if (count($is_already_enroll) <= 0) {
                StudentCourseHistory::create([
                    'student_id' => Auth::user()->id,
                    'course_id' => $is_enroll_course_id
                ]);

                $username = User::find(Auth::user()->id);
                $course = Course::find($is_enroll_course_id);

                $query = User::whereIn('role', ['Superadmin', 'Admin', 'Credentials']);
                $users = $query->get();

                foreach ($users as $user) {
                    Notification::create([
                        'user_id' => $user->id,
                        'description' => Auth::user()->email . ' has enrolled in the course ' . $course->name
                    ]);
                }
            } else {
                if ($is_already_enroll[0]->is_paid == 1) {
                    return redirect()->route('manage_payment')->withErrors(['error' => 'Course is already purchased, please check in payment history section']);
                }
            }
        }

        $pending_payment_course = StudentCourseHistory::leftJoin('courses', 'courses.id', '=', 'student_course_history.course_id')
            ->where('student_course_history.student_id', Auth::user()->id)
            ->where('student_course_history.is_paid', '0')
            ->get();

        return view('frontend.payment.manage_payment', compact('pending_payment_course'));
    }

    public function remove_course_enroll()
    {
        $course_id = request()->segment(2);
        $delete = StudentCourseHistory::where('student_id', Auth::user()->id)->where('course_id', $course_id)->delete();

        return redirect('/manage_payment')->with('success', 'Course remove successfully');
    }

    public function pay_for_courses()
    {
        $courses_to_paid = StudentCourseHistory::where('student_id', Auth::user()->id)
            ->where('is_paid', '0')
            ->get();
        $price_sum = 0;
        if (!empty($courses_to_paid)) {
            foreach ($courses_to_paid as $course) {
                $price_sum += $course->price;
            }
        }
        $user_data = User::find(Auth::user()->id);
        $prefix = "GA";
        $number = substr(str_shuffle("0123456789"), 0, 12);
        $order_number = $prefix . $number;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fatora.io/v1/payments/checkout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'api_key:  E4B73FEE-F492-4607-A38D-852B0EBC91C9'
            ),
            CURLOPT_POSTFIELDS => '{
                "amount": ' . $price_sum . ',
                "currency": "QAR",
                "order_id": "' . $order_number . '",
                "client" : {
                    "name" : "' . $user_data->name . '",
                    "phone" : "' . $user_data->phone . '",
                    "email" : "' . $user_data->email . '"
                },
                "language":"en",
                "success_url" : "' . url('') . '/fatora_success",
                "failure_url" : "' . url('') . '/fatora_cancel",
                "fcm_token" : "XXXXXXXXX",
                "save_token" : true,
                "note": ""
                }'
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['result']['checkout_url'])) {
            return redirect()->away($result['result']['checkout_url']);
        } else {
            return redirect()->back()->with('error', 'Unable to process payment. Please try again.');
        }
    }

    public function fatora_cancel()
    {
        return redirect('/my_account')->with('error', 'Payment failed for course');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function fatora_success(Request $request)
    {
        try {
            StudentCourseHistory::where('student_id', Auth::user()->id)
                ->where('is_paid', '0')
                ->update(['is_paid' => '1']);

            return redirect('/my_account')->with('success', 'Payment successful for course');
        } catch (\Exception $ex) {
            die($ex);
        }
    }
}
