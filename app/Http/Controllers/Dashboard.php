<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');

    }

    public function dashboard()
    {

        return view('admin.index');
    }


    public function login()
    {
        return 'login page';
    }
}
