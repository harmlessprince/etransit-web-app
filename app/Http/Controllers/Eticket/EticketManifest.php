<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Passenger;
use App\Models\Schedule;
use Illuminate\Http\Request;
use DataTables;

class EticketManifest extends Controller
{
    public function manifest($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
        $bookings =  Passenger::where('schedule_id',$schedule_id)->count();
        $tranx =  Transaction::where('schedule_id', $schedule_id)->pluck('amount')->sum();




        return  view('Eticket.bus.manifest', compact('schedule','bookings','tranx'));
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

    public function fetchPassengerDetails($seat_tracker_id)
    {
        $passenger =  Passenger::where('seat_tracker_id',$seat_tracker_id)->first();

        return response()->json(['success' => true , 'data' => compact('passenger')]);
    }
}
