<?php

namespace App\Http\new_Controllers\Api;

use App\Classes\VerificationToken;
use App\Http\Controllers\Controller;
use App\Mail\VerificationToken as VerificationTokenMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    public function resendEmailVerifyToken(Request $request)
    {
        request()->validate([
            'email' => 'required'
        ]);

        $findUser = User::where('email',$request->email)->first();

        if(!$findUser)
        {
            return response()->json(['success' => false , 'message' => 'User not found']);
        }

        $verifyToken = VerificationToken::generate();

        $findUser->update([
            'verification_token' => $verifyToken
        ]);

        $maildata = [
            'verify_token' => $verifyToken
        ];

        Mail::to($request->get('email'))->send(new VerificationTokenMail($maildata));


        return response()->json(['success' => true , 'message' => 'Token sent successfully']);
    }
}
