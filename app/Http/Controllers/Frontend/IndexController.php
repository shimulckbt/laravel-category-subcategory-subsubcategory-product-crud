<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.profile.show', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/' . $user['profile_photo_path']));

            $filename = date('YmdHi') . $file->getClientOriginalName();

            $file->move(public_path('upload/user_images'), $filename);
            $user['profile_photo_path'] = $filename;
        }
        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully..!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.profile')->with($notification);
    }
}
