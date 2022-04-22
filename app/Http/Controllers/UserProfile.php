<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Controller
{
    public function myProfile()
    {
        return view('pages.profile.my-profile');
    }

    public function updateUserProfile(Request $request , $user_id)
    {
         $request->validate([
             'full_name' => 'required',
             'phone_number' => 'required',
             'address' => 'required',
             'password' => 'sometimes',
             'confirm_password'=>'sometimes'
         ]);

            $update_user = \App\Models\User::where('id',$user_id)->firstorfail();



            if(!is_null($request->password))
            {
                    if($request->password != $request->confirm_password)
                    {
                        toastr()->error('Your password does not match');
                        return back();
                    }else{
                        $update_user->update([
                            'full_name' => $request->full_name,
                            'phone_number' => $request->phone_number,
                            'address' => $request->address,
                            'password' => Hash::make($request->password),
                        ]);
                    }
                }else{
                    $update_user->update([
                        'full_name' => $request->full_name,
                        'phone_number' => $request->phone_number,
                        'address' => $request->address
                    ]);
                }

            toastr()->success('Profile Updated successfully');
            return back();
        }


}
