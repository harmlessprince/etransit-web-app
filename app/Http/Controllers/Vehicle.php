<?php

namespace App\Http\Controllers;

use App\Models\SeatTracker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehicleExport;
use App\Imports\VehicleImport;
use App\Models\Bus;
use App\Models\Terminal;
use App\Models\Transaction;
use App\Models\Schedule;
use DataTables;

class Vehicle extends Controller
{
    public function manage()
    {
        $vehicles = \App\Models\Bus::withoutGlobalScopes()->orderby('id','desc')->get();

        return view('admin.vehicle.manage' , compact('vehicles'));
    }

    public function tenantBus()
    {
        $terminalCount  = Terminal::count();
        $busesCount     = Bus::count();
        $transactionsCount = Transaction::pluck('amount')->sum();

        return view('admin.vehicle.manage-tenant-bus' , compact('terminalCount','busesCount','transactionsCount'));
    }

    public function fetchAllTenantBus(Request $request)
    {
        if ($request->ajax()) {
            $data = Bus::withoutGlobalScopes()->with('tenant')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-driver/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/manage/view-tenant-bus/$id'  class='edit btn btn-success btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function viewTenantBus($bus_id)
    {
        $findBus = Bus::with('driver', 'schedules','tenant')->where('id',$bus_id)->first();

        return  view('admin.vehicle.view-bus', compact('findBus'));
    }

    public function busSchedule($bus_id)
    {
        $bus = Bus::where('id',$bus_id)->first();
        return view('admin.vehicle.each-bus-schedule', compact('bus'));
    }

    public function busScheduleFetch(Request $request , $bus_id)
    {
        if ($request->ajax()) {
            $data = Schedule::withoutGlobalScopes()->where('bus_id',$bus_id)->with('pickup','destination','bus','terminal')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-bus-schedule-page/$id'  class='edit btn btn-success btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function viewBusSchedulePage($schedule_id)
    {
        $findSchedule = Schedule::where('id',$schedule_id)->first();
        $seatTracker = SeatTracker::where('schedule_id',$schedule_id)->get();

        return view('admin.vehicle.schedule-single-page', compact('findSchedule','seatTracker'));
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
