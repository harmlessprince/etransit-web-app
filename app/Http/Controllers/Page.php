<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Page extends Controller
{
    public function index()
    {

        $busService = \App\Models\Service::where('id' , 1)->first();
        $locations = \App\Models\Destination::get();
        $tripTypes = \App\Models\TripType::get();
        $pickups = \App\Models\Pickup::get();



        return view('pages.new-index',compact('busService','locations','tripTypes','pickups'));
    }
}
