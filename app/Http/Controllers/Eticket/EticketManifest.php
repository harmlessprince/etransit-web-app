<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Schedule;
use Illuminate\Http\Request;
use DataTables;

class EticketManifest extends Controller
{
    public function manifest($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);

        return  view('Eticket.bus.manifest', compact('schedule'));
    }

    public function fetchBusManifest(Request $request , $schedule_id)
    {

        if ($request->ajax()) {
            $data = Passenger::where('schedule_id',$schedule_id)->with(['user','seat_position'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/view-tenant-bus/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
