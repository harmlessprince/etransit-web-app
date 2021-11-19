<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
{

    public function getUserProfile()
    {
        $user = auth()->user();
        $user = User::where('id',$user->id)->select('id','full_name','email','address','username','phone_number')->firstorfail();

        return response()->json(['success' => true , 'data' => compact('user') ]);
    }


    public function profileUpdate()
    {
        $data = request()->validate([
            'full_name' => 'required',
            'email'     => 'required',
            'phone_number' => 'required',
            'password'    => 'sometimes',
        ]);
        $user = auth()->user();

        $user = User::where('id',$user->id)->firstorfail();

        if(is_null($data['password']))
        {
            $user->update([
                'full_name' => $data['full_name'],
                'email'    => $data['email'],
                'phone_number' => $data['phone_number']
            ]);
        }else{
            $user->update([
                'full_name' => $data['full_name'],
                'email'    => $data['email'],
                'phone_number' => $data['phone_number'],
                'password'=> Hash::make($data['password'])
            ]);
        }

        return response()->json(['success' => true , 'message' => 'Profile updated successfully']);

    }
}
