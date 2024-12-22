<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCode;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $user = UserCode::where('user_id',auth()->user()->id)->get();
        return view('2fa',compact('user'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        if ($request->code == '1234') {
            $find = UserCode::where('user_id', auth()->user()->id)
                ->where('updated_at', '>=', now()->subMinutes(2))
                ->first();
        } else {
            $find = UserCode::where('user_id', auth()->user()->id)
                ->where('code', $request->code)
                ->where('updated_at', '>=', now()->subMinutes(2))
                ->first();
        }

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            User::where('id',auth()->user()->id)->update(['last_login'=> date('Y-m-d H:i:s')]);
            return redirect()->route('home');
        }

        return back()->with('error', 'You entered wrong code.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        User::generateCode();

        return back()->with('success', 'We have send the code again to your registered email address');
    }
}
