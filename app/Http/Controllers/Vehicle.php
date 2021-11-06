<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehicleExport;
use App\Imports\VehicleImport;
use App\Models\Bus;

class Vehicle extends Controller
{
    public function manage()
    {
        $vehicles = \App\Models\Bus::orderby('id','desc')->get();
        return view('admin.vehicle.manage' , compact('vehicles'));
    }

    public function importExportView()
    {
        return view('admin.vehicle.import');
    }

    public function addVehicle(Request $data)
    {

        $vehicle = new Bus();
        $vehicle->car_type = $data['car_type'];
        $vehicle->car_model = $data['car_model'];
        $vehicle->car_registration = $data['car_registration'];
        $vehicle->air_conditioning = $data['Ac_status'];
        $vehicle->wheels = $data['wheels'];
        $vehicle->seater = $data['seats'];
        $vehicle->save();

        toastr()->success('Data saved successfully');
       return response()->json(['success' => true , 'message' => 'Vehicle saved successfully']);

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportVehicle()
    {
        $vehicles = Bus::select(["id", "car_type", "car_model", "car_registration" , "air_conditioning" , "wheels","seater"])->get();

        return Excel::download(new VehicleExport($vehicles), 'vehicle.xlsx');

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importVehicle(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new VehicleImport,request()->file('excel_file'));
        toastr()->success('Data saved successfully');
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

}
