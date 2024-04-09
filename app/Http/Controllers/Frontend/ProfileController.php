<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helper\CommonHelper as Helper;
class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.update_profile',compact('user'));
    }

    public function change_password()
    {
        return view('frontend.profile.change_password');
    }

    public function submit_change_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
            'lastname' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:20',
            'contact' => 'required|numeric|digits:10',
            'photo' => 'mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $user = User::where('id', Auth::user()->id)->first(); // change here id
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->marital_status = $request->marital_status;
        $user->phone = $request->contact;
        $user->religion = $request->religion;
        $user->nationality = $request->nationality;
        $user->present_address = $request->present_address;
        $user->permananat_address = $request->permanant_address;
        $user->country_code = $request->country_code;
        if ($request->hasFile('photo')) {
            $user->photo = Helper::uploadDocuments($request, 'photo', 'uploads/profile/images');
        }
        $user->save();

        if ($user) {
            return back()->with('success', 'Profile changed successfully');
        }
    }

    public function submit_change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'old_password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user = User::where('id', Auth::user()->id)->first(); // change here id
            $user->password = Hash::make($request->password);
            $user->save();
    
            if ($user) {
                return back()->with('success', 'Password changed successfully');
            }
        } else {
            return back()
            ->withInput()
            ->withErrors(['msg' => 'Authenticate failed!! please enter correct old password']);
        }
    }
}
