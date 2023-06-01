<?php

namespace App\Http\new_Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public  function login()
    {
        return view('auth.login');
    }

    public  function register()
    {
        return view('auth.register');
    }
}
