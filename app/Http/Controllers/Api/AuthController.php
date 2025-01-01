<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Error validation', $validator->errors());
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $authUser = Auth::user();
                return $this->sendResponse($authUser, 'Please check you inbox, we have emailed you to confirm your email address');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised!! Email or Password is incorrect.']);
            }
        } catch (\Exception $e) {
            return $this->sendError('Exception', ['error' => $e->getMessage()]);
        }
    }

    public function signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                'lastname' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
                'username' => 'required|unique:users,username|min:5|max:15',
                'role' => 'required',
                'age' => 'required|numeric',
                'address' => 'required|max:500',
                'phone_number' => 'required|numeric',
                'emergency_contact' => 'required|numeric',
                'photo' => 'required|mimes:jpeg,png,jpg|max:10000',
                'health_certificate' => 'mimes:png,pdf,jpg,jpeg|max:10000',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Error validation', $validator->errors());
            }

            $user = $this->auth->signUp($request);
            if ($user) {
                return $this->sendResponse($user, 'Please check you inbox, we have emailed you to confirm your email address');
            } else {
                return $this->sendError('Error.', ['error' => 'Error in user creating.']);
            }
        } catch (\Exception $e) {
            return $this->sendError('Exception', ['error' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Session::flush();
        return $this->sendResponse([], 'logged out');
    }
}
