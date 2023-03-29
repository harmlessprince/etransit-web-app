<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialCallback($provider){

        $userSocial =   Socialite::driver($provider)->user();
        $users      =  User::where(['email' => $userSocial->getEmail()])->first();

        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            $user = User::create([
                'full_name'         => $userSocial->getEmail(),
                'email_verified_at'  => Carbon::now(),
                'email'             => $userSocial->getEmail(),
                'password'          => Hash::make($userSocial->getEmail()),
                'image'             => $userSocial->getAvatar(),
                'provider_id'       => $userSocial->getId(),
                'provider'          => 'google',
            ]);
            
            Auth::login($user);
            return redirect('/');
        }
    }

    public function callback(){

        $userSocial =   Socialite::driver('google')->user();
        $users      =  User::where(['email' => $userSocial->getEmail()])->first();

        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            $user = User::create([
                'full_name'         => $userSocial->getEmail(),
                'email_verified_at'  => Carbon::now(),
                'email'             => $userSocial->getEmail(),
                'password'          => Hash::make($userSocial->getEmail()),
                'image'             => $userSocial->getAvatar(),
                'provider_id'       => $userSocial->getId(),
                'provider'          => 'google',
            ]);
            
            Auth::login($user);
            return redirect('/');
        }
    }
}
