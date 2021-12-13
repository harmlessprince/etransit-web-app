<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ferry as FerryBoat;
use App\Models\Service;

class Ferry extends Controller
{
    public function index()
    {
        $ferries = FerryBoat::all();
        return view('admin.ferry.index' , compact('ferries'));
    }


    public function create()
    {

        $service = Service::where('id' , 3)->firstorfail();

        return view('admin.ferry.create', compact('service'));
    }
}
