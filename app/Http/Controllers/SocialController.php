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
        return Socialite::driver($provider)->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->redirect();
    }

    public function Callback(){

        $userSocial = Socialite::driver('google')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();
        $users = User::where(['email' => $userSocial->getEmail()])->first();

        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            $user = User::create([
                'full_name'         => $userSocial->getName(),
                'email_verified_at'  => Carbon::now(),
                'email'             => $userSocial->getEmail(),
                'password'          => Hash::make($userSocial->getEmail()),
                'image'             => $userSocial->getAvatar(),
                'provider_id'       => $userSocial->getId(),
                'provider'          => 'google',
            ]);

            if($user){
                Auth::login($user);
            }
            return redirect('/');
        }
    }
}
