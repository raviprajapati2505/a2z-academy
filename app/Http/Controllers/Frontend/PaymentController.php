<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\StudentCourseHistory;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

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
        $sum = 500;
        $apiContext = new ApiContext(
            new OAuthTokenCredential('ClientID',  'ClientSecret')
        );
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal_success'))
            ->setCancelUrl(route('paypal_cancel'));

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($sum);

        // Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription(" Hello ");

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);

            return redirect($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (\Exception $ex) {
            die($ex);
        }
    }

    public function cancel()
    {
        return redirect('/my_account');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential('ClientID', 'ClientSecret')
        );
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            StudentCourseHistory::where('student_id', Auth::user()->id)
                ->where('is_paid', '0')
                ->update(['is_paid' => '1']);

            return redirect('/my_account');
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (\Exception $ex) {
            die($ex);
        }
    }
}
