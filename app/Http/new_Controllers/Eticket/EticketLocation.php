<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class EticketLocation extends Controller
{
    public function manageLocations()
    {
        return view('Eticket.location.index');
    }

    public function fetchLocation(Request $request)
    {
        if ($request->ajax()) {
            $data = Destination::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/view-tenant-location/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addLocation()
    {
        return view('Eticket.location.add-location');
    }

    public function storeLocation(Request $request)
    {
        request()->validate([
            'location' => 'required',
        ]);

        $destination = new Destination;
        $destination->location = $request->location;
        $destination->tenant_id = session()->get('tenant_id');
        $destination->save();

        Alert::success('Success ', 'Location added successfully');

        return redirect('e-ticket/locations');
    }

    public function viewLocation($location_id)
    {
        $location = Destination::with('terminals')->find($location_id);


        return view('Eticket.location.view-location', compact('location'));
    }
}
