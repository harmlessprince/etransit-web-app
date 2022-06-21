<?php

namespace App\Http\Controllers;

use App\Models\FerryLocation;
use App\Models\FerryType;
use App\Models\Service;
use App\Models\TrainLocation;
use App\Models\TrainStop;
use App\Models\TripType;
use Illuminate\Http\Request;

class Page extends Controller
{

//    public function __construct()
//    {
//        $this->middleware(['auth','verified']);
//    }

    public function index()
    {

        $busService = \App\Models\Service::where('id' , 1)->first();
        $locations = \App\Models\Destination::get();
        $tripTypes = \App\Models\TripType::get();
        $pickups = \App\Models\Pickup::get();

        $FerryService = Service::where('id', 3)->firstorfail();
        $ferryTypes = FerryType::all();
        $ferryLocations = FerryLocation::all();

        $train_locations = \App\Models\TrainLocation::all();

        return view('pages.new-index',compact('busService','locations','tripTypes','pickups' ,'ferryLocations','ferryTypes','FerryService','train_locations'));
    }
}
