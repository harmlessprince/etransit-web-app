<?php

namespace App\Http\new_Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function contact(){
        return view('pages.contact');
    }

    public function about(){

        return view('pages.about');
    }

    public function policy()
    {
        return view('pages.policy');
    }
}
