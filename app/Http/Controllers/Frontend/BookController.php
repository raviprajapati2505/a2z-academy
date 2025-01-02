<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\StudentBookHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function book_store()
    {
        $books = Book::all();
        return view('frontend.book.book_store', compact('books'));
    }

    public function pay_for_book($id)
    {
        $price_sum = Book::find($id)->price;
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
                "success_url" : "' . url('') . '/fatora_success_book?book_id=' . $id . '",
                "failure_url" : "' . url('') . '/fatora_cancel_book",
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

    public function fatora_cancel_book()
    {
        return redirect('/my_account')->with('error', 'Payment failed for book');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function fatora_success_book(Request $request)
    {
        $book_id = $request->query('book_id');

        StudentBookHistory::create([
            'student_id' => Auth::user()->id,
            'book_id' => $book_id,
            'is_paid' => 1
        ]);
        try {
            return redirect('/my_account')->with('success', 'Payment successful for Book ID: ' . $book_id);
        } catch (\Exception $ex) {
            die($ex);
        }
    }
}
