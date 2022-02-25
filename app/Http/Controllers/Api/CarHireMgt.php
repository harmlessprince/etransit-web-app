<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarClass;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarHireMgt extends Controller
{
    public function allCars()
    {
        return view('Eticket.car-hire.all-cars');
    }

    public function createCars()
    {

        $classes = CarClass::all();
        $types = CarType::all();

        return view('Eticket.car-hire.create-cars', compact('classes','types'));
    }
}
