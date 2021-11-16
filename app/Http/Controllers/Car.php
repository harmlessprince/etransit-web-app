<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car as HiredCars;

class Car extends Controller
{
    public function allCars()
    {
        $cars = HiredCars::all();

        return view('admin.cars.cars', compact('cars'));
    }

    public function addCars(Request $request)
    {
           $data  = request()->validate([
                            'car_name' => 'required',
                            'car_type' => 'required',
                            'description' => 'required',
                            'capacity' => 'required',
                            'mileage' => 'required'
                        ]);

           $car                = new HiredCars();
           $car->car_name      = $data['car_name'];
           $car->car_type      = $data['car_type'];
           $car->description   = $data['description'];
           $car->capacity      = (int)  $data['capacity'];
           $car->mileage       = $data['mileage'];

           $car->save();

             return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);

    }


    public function carList()
    {
        $cars = HiredCars::all();

        return view('pages.car-hire.hire', compact('cars'));
    }
}
