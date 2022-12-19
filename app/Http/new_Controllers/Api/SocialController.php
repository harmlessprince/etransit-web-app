<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use JWTAuth;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider){

        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users      =  User::where(['email' => $userSocial->getEmail()])->first();

        if($users){

            Auth::login($users);

            $token = JWTAuth::attempt($userSocial->getEmail() , $userSocial->getEmail());

            return response()->json(['success' => true , 'data' => compact('token')]);
        }else{
            $user = User::create([
                'full_name'         => $userSocial->getName(),
                'email_verified_at' => Carbon::now(),
                'email'             => $userSocial->getEmail(),
                'password'          => Hash::make($userSocial->getEmail()),
                'image'             => $userSocial->getAvatar(),
                'provider_id'       => $userSocial->getId(),
                'provider'          => $provider,
            ]);

            $token = JWTAUTH::fromUser($user);
            return response()->json(['success' =>  true , 'data' => compact('token')]);
        }
    }


    public function acceptToken(Request $request)
    {
       request()->validate([
           'token' => 'required'
       ]);
    }
}
