<?php

namespace App\Http\Controllers;

use App\Models\BusType;
use App\Models\Destination;
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
use RealRashid\SweetAlert\Facades\Alert;

class Vehicle extends Controller
{
    public function manage()
    {
        $vehicles = \App\Models\Bus::withoutGlobalScopes()->orderby('id','desc')->get();

        return view('admin.vehicle.manage' , compact('vehicles'));
    }

    public function tenantBus()
    {
        $terminalCount  = Terminal::withoutGlobalScopes()->count();
        $busesCount     = Bus::withoutGlobalScopes()->count();
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
                    $actionBtn = "<a href='/admin/manage/view-tenant-bus/$id'  class='edit btn btn-success btn-sm'>View</a>";
//                    <a href='/admin/edit-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a>
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

    public function editBus($bus_id)
    {
        $bus  = Bus::withoutGlobalScopes()->find($bus_id);

        return view('admin.vehicle.edit-bus',compact('bus'));
    }

    public function updateBus(Request $request , $bus_id)
    {
        $request->validate([
            'bus_model' => 'required',
            'bus_type' => 'required',
            'bus_registration' => 'required',
            'wheels' => 'required',
            'seater'=> 'required'
        ]);

       $bus = Bus::withoutGlobalScopes()->where('id',$bus_id)->first();

        $bus->update([
            'bus_model' => $request->bus_model,
            'bus_type' => $request->bus_type,
            'bus_registration' => $request->bus_registration,
            'wheels' => $request->wheels,
            'tenant_id' => session()->get('tenant_id'),
            'seater' => $request->seater,
            'service_id' => 1,
            'air_conditioning' =>  $request->air_conditioning == 'on' ? 1 : 0 ,
        ]);


        Alert::success('Success ', 'Bus updated successfully');

        return redirect('admin/manage/tenant-bus');
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

    public function allBusTypes()
    {
        return view('admin.vehicle.bus-type');
    }

    public function addBusType()
    {
        return view('admin.vehicle.add-bus-type');
    }

    public function storeBusType(Request $request)
    {
        $request->validate(['bus_type' => 'required']);

        $newBusType = new BusType();
        $newBusType->type = $request->bus_type;
        $newBusType->save();

        Alert::success('Success ', 'Bus Type Added successfully');

        return redirect('admin/manage/bus-type');

    }

    public function busTypeFetch(Request $request)
    {
        if ($request->ajax()) {
            $data = BusType::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/update/bus-type/$id'  class='edit btn btn-success btn-sm'>Edit</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function EditBusType(Request $request , $bus_type_id)
    {
        $busType = BusType::where('id', $bus_type_id)->first();

        return view('admin.vehicle.edit-bus-type' , compact('busType'));
    }

    public function updateBusType(Request $request ,$bus_type_id)
    {
        $request->validate(['bus_type' => 'required']);

        $busType = BusType::where('id', $bus_type_id)->first();

        $busType->update(['type' => $request->bus_type]);

        Alert::success('Success ', 'Bus Type Added successfully');

        return redirect('admin/manage/bus-type');
    }

    public function destinations()
    {
        return view('admin.vehicle.bus-destination');
    }

    public function addBusLocation()
    {
        return view('admin.vehicle.add-bus-destination');
    }

    public function storeBusLocation(Request $request)
    {
        $request->validate(['location' => 'required']);
        $location = new Destination();
        $location->location = $request->location;
        $location->save();
        Alert::success('Success ', 'Location Added successfully');
        return redirect('admin/manage/bus-destination');
    }

    public function fetchBusLocation(Request $request)
    {
        if ($request->ajax()) {
            $data = Destination::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/update/bus-location/$id'  class='edit btn btn-success btn-sm'>Edit</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updateBusLocation($location_id)
    {
        $location = Destination::where('id' , $location_id)->first();

        return view('admin.vehicle.edit-bus-destination' , compact('location'));
    }

    public function editVehicleLocation(Request $request ,$location_id)
    {
        $request->validate(['location' => 'required']);

        $location = Destination::where('id' , $location_id)->first();

        $location->update(['location' => $request->location]);

        Alert::success('Success ', 'Location Updated successfully');

        return redirect('admin/manage/bus-destination');


    }







}
