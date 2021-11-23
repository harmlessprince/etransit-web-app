<?php

namespace App\Http\Controllers;


use App\Exports\CarsExport;
use App\Imports\CarsImport;
use Illuminate\Http\Request;
use App\Models\Car as HiredCars;
use Maatwebsite\Excel\Facades\Excel;

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
                            'nc_fare' => 'required',
                            'description'=> 'required',
                            'capacity' => 'required'
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
               $car->description     = $data['description'];
               $car->capacity        = $data['capacity'];
               $car->save();

             return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);

    }


    public function carList()
    {
        $cars = HiredCars::where('functional',1)->get();


        return view('pages.car-hire.hire', compact('cars'));
    }


    public function carHistory($car_id)
    {

        $carHistory = HiredCars::where('id',$car_id)->firstorfail();

        return view('admin.cars.history', compact('carHistory'));
    }

    public function importExportViewCars()
    {
        return view('admin.cars.import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportCar()
    {
        $cars = HiredCars::select('id','car_type','car_class','daily_rentals'
                                ,'extra_hour','sw_fare','ss_fare','se_fare','nc_fare','description','capacity' )->get();

        return Excel::download(new CarsExport($cars), 'cars.xlsx');

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importCars(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new CarsImport,request()->file('excel_file'));

        toastr()->success('Data saved successfully');

        return response()->json(['message' => 'uploaded successfully'], 200);
    }
}
