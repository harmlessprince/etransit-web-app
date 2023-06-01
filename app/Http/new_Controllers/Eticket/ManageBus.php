<?php

namespace App\Http\new_Controllers\Eticket;

use App\Exports\VehicleExport;
use App\Http\Controllers\Controller;
use App\Imports\VehicleImport;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\Destination;
use App\Models\Schedule;
use App\Models\Tenant;
use App\Models\Terminal;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Driver;

class ManageBus extends Controller
{
    public function allBuses()
    {
        $busCount = Bus::count();
        $terminalCount = Terminal::count();
        $schedule = Schedule::count();



        return view('Eticket.bus.index' , compact('busCount','terminalCount','schedule'));
    }


    public function fetchOBuses(Request $request)
    {
        if ($request->ajax()) {
            $data = Bus::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-tenant-bus/$id' class='delete btn btn-primary btn-sm'>View</a>";

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function viewBus($bus_id)
    {
        $findBus = Bus::where('tenant_id',session()->get('tenant_id'))->where('id', $bus_id)->with('driver','schedules')->first();

        return view('Eticket.bus.view',compact('findBus'));
    }


    public function addNewBus()
    {
        $busTypes = BusType::all();
        return view('Eticket.bus.new' , compact('busTypes'));
    }

    public function createTenantBus(Request $request)
    {

       $this->validateBuRequest($request);

       //service ID 1 == Bus Booking
        //the value should change if there are changes to the way the service is arranged
       $newBus = new Bus;
       $newBus->bus_model = $request->bus_model;
       $newBus->bus_type = $request->bus_type;
       $newBus->bus_registration = $request->bus_registration;
       $newBus->wheels = $request->wheels;
       $newBus->tenant_id = session()->get('tenant_id');
       $newBus->seater = $request->seater;
       $newBus->service_id = 1;
       $newBus->air_conditioning  = $request->air_conditioning == 'on' ? 1 : 0 ;
       $newBus->save();

        Alert::success('Success ', 'Bus added successfully');

       return redirect('e-ticket/buses');
    }

    public function assignDriver($bus_id)
    {
        $bus = Bus::find($bus_id);

        return view('Eticket.bus.assign-driver', compact('bus'));
    }

    public function assignDriverToBus(Request $request , $bus_id)
    {
        request()->validate([
            'driver_phone_number' => 'required'
        ]);

        $findBus = Bus::find($bus_id);

        if(!$findBus)
        {
            Alert::error('Error', 'No bus found');
            return back();
        }


        $findDriver = Driver::where('tenant_id', session()->get('tenant_id'))->where('phone_number', $request->driver_phone_number)->first();

        if(!$findDriver)
        {
            Alert::error('Error', 'No driver driver found with that number in your organization');
            return back();
        }

        $findBus->update([
            'driver_id'=>$findDriver->id
        ]);

        Alert::success('Success ', 'Driver assigned to bus successfully');

        return redirect('e-ticket/view-tenant-bus/'.$bus_id);

    }


    public function removeDriverFromBus($driver_id , $bus_id)
    {
        $findDriver = Driver::find($driver_id);

        if(!$findDriver)
        {
            Alert::error('Error', 'No driver driver found with that number in your organization');
            return back();
        }

        $findBus = Bus::find($bus_id);

        $findBus->update([
            'driver_id' => null
        ]);

        Alert::success('Success ', 'Driver removed from bus successfully');

        return redirect('e-ticket/view-tenant-bus/'.$bus_id);
    }


    public function scheduleTrip($bus_id)
    {
        $bus = Bus::find($bus_id);

        if(!$bus)
        {
            Alert::error('Error ', 'Unable to fetch bus');
            return back();
        }

        $locations = Destination::all();
        $terminals = Terminal::all();

        return view('Eticket.bus.schedule-event', compact('bus','locations','terminals'));

    }

    public function editBus($bus_id)
    {
        $bus = Bus::with('driver')->find($bus_id);

        return view('Eticket.bus.edit-bus' , compact('bus'));
    }


    public function updateBus(Request $request , $bus_id)
    {
//        $this->validateBuRequest($request);
        $bus = Bus::find($bus_id);
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

        return redirect('e-ticket/buses');
    }


    public function importExportView()
    {
        return view('Eticket.bus.import-bus');
    }

    public function addVehicle(Request $data)
    {

        $vehicle = new Bus();
        $vehicle->bus_type = $data['bus_type'];
        $vehicle->bus_model = $data['bus_model'];
        $vehicle->bus_registration = $data['bus_registration'];
        $vehicle->air_conditioning = $data['Ac_status'];
        $vehicle->wheels = $data['wheels'];
        $vehicle->seater = $data['seats'];
        $vehicle->tenant_id = session()->get('tenant_id');
        $vehicle->save();

        toastr()->success('Data saved successfully');
        return response()->json(['success' => true , 'message' => 'Vehicle saved successfully']);

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportVehicle()
    {
        $vehicles = Bus::select(["id", "bus_type", "bus_model", "bus_registration" , "air_conditioning" , "wheels","seater"])->get();

        return Excel::download(new VehicleExport($vehicles), 'bus.xlsx');

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



    private function validateBuRequest($request)
    {
          $request->validate([
                'bus_model' => 'required',
                'bus_type' => 'required',
                'bus_registration' => 'required|unique:buses',
                'wheels' => 'required',
                'seater'=> 'required',
                'driver_phone_number' => 'sometimes'
            ]);
    }

}
