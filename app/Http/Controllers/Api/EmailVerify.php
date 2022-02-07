<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerify extends Controller
{
    public function verifyEmail(Request $request)
    {
        request()->validate([
            'token' => 'required'
        ]);

        $findUser = User::where('verification_token',$request->token)->first();
        if(!$findUser)
        {
            return response()->json(['success' => false , 'message' => 'Token not found']);
        }
        $findUser->update([
            'email_verified_at' => Carbon::now(),
            'verification_token' => null,
        ]);

        return response()->json(['success' => true , 'message' =>'Email verification is successful']);

    }
}
