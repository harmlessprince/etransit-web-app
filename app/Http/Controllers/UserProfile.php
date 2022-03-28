<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfile extends Controller
{
    public function myProfile()
    {
        return view('pages.profile.my-profile');
    }

    public function updateUserProfile(Request $request , $user_id)
    {

    }
}
