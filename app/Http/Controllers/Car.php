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
                            'car_type' => 'required',
                            'car_class' => 'required',
                            'daily_rentals' => 'required',
                            'extra_hour' => 'required',
                            'sw_fare' => 'required',
                            'ss_fare' => 'required',
                            'se_fare' => 'required',
                            'nc_fare' => 'required'
                        ]);

               $car                  = new HiredCars();
               $car->car_class       = $data['car_class'];
               $car->car_type        = $data['car_type'];
               $car->daily_rentals   = $data['daily_rentals'];
               $car->extra_hour      = $data['extra_hour'];
               $car->sw_fare         = $data['sw_fare'];
               $car->ss_fare         = $data['ss_fare'];
               $car->se_fare         = $data['se_fare'];
               $car->nc_fare         = $data['nc_fare'];
               $car->save();

             return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);

    }


    public function carList()
    {
        $cars = HiredCars::all();

        return view('pages.car-hire.hire', compact('cars'));
    }


    public function carHistory($car_id)
    {

        $carHistory = HiredCars::where('id',$car_id)->firstorfail();

        return view('admin.cars.history', compact('carHistory'));
    }
}
