<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Page extends Controller
{
    public function index()
    {

        $busService = \App\Models\Service::where('id' , 1)->first();
        $locations = \App\Models\Destination::all();


        return view('pages.index',compact('busService','locations'));
    }
}
