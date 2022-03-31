<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DataTables;


class Manifest extends Controller
{
    public function manifest($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
        $bookings =  Passenger::where('schedule_id',$schedule_id)->whereHas('seat_position', function ($query) {
                                             $query->where('booked_status','=','2');})
                                            ->with('user','schedule' ,'seat_position')
                                            ->count();
        $tranx =  Transaction::where('schedule_id', $schedule_id)->pluck('amount')->sum();


        $manifests =  Passenger::where('schedule_id',$schedule_id)->whereHas('seat_position', function ($query) {
                                        $query->where('booked_status','=','2');
                                         })
                                        ->with('user','schedule' ,'seat_position')
                                        ->get();


        return  view('admin.vehicle.manifest', compact('schedule','bookings','tranx' ,'manifests'));
    }


    public function fetchBusManifest(Request $request , $schedule_id)
    {

        if ($request->ajax()) {
            $data = Passenger::where('schedule_id',$schedule_id)->with(['user','seat_position'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-tenant-bus/$id' class='delete btn btn-primary btn-sm'>View</a>";
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
