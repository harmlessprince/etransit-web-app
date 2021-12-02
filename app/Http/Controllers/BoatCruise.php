<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class BoatCruise extends Controller
{
    public function boatCruiseList()
    {

        $service = Service::where('id', 7)->firstorfail();

        return view('pages.boat-cruise.list', compact('service'));
    }


    public function boatCruiseShow()
    {
        $service = Service::where('id', 7)->firstorfail();

        return view('pages.boat-cruise.show', compact('service'));
    }
}
