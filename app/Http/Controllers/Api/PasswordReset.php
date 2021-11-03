<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetEmailNotification;
use App\Notifications\PasswordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class PasswordReset extends Controller
{
    public function forgotPasswordNotification(Request $request)
    {
       $data = request()->validate([
            'email' => 'required'
        ]);

       $user = User::where('email', $data['email'])->first();

       !$user ? abort(404): '' ;
       
       $FourDigitRandomNumber = mt_rand(11111,99999);
       $user->update(['reset_pin' => $FourDigitRandomNumber]);
       SendPasswordResetEmailNotification::dispatch($FourDigitRandomNumber , $user);

       return response()->json(['success' => true ], 201);
    }

    public function resetPassword(Request $request)
    {
          $data = request()->validate([
                    'reset_pin' => 'required',
                    'password' => 'required|confirmed'
                ]);


          $findUserPin = User::where('reset_pin', $data['reset_pin'])->first();

          if(!$findUserPin)
          {
              return response()->json(['success' => false , 'message' => 'Incorrect pin']);
          }

          $findUserPin->update([
                'password'=> Hash::make($data['password']),
                'reset_pin' => null,
          ]);

          return response()->json(['success' => true , 'message' => 'Password has been reset successfully']);



    }
}
