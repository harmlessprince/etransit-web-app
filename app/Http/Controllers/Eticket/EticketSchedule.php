<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Schedule as EventSchedule;
use App\Models\SeatTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class EticketSchedule extends Controller
{
    public function addEticketSchedule(Request $request)
    {

        request()->validate([
            'departureTime'=> 'required',
            'Tfare'        => 'required',
            'TfareChild'   => 'required'
        ]);

        $service = \App\Models\Terminal::where('id',$request['terminal'])->with('service')->first();
        $numberOfSeats = \App\Models\Bus::where('id',$request['busId'])->select('seater')->first();

        $serviceID = $service->id;
        try {
            DB::beginTransaction();
            $scheduleEvent = new EventSchedule();
            $scheduleEvent->terminal_id       = (int)$request['terminal'];
            $scheduleEvent->service_id        = (int) $serviceID;
            $scheduleEvent->bus_id            = (int) $request['busId'];
            $scheduleEvent->pickup_id         = (int) $request['pickUp'];
            $scheduleEvent->destination_id    = (int) $request['destination'];
            $scheduleEvent->fare_adult        = $request['Tfare'];
            $scheduleEvent->fare_children     = $request['TfareChild'];
            $scheduleEvent->departure_date    = $request['eventDate'];
            $scheduleEvent->departure_time    = $request['departureTime'];
            $scheduleEvent->return_date       = $request['returnDate'];
            $scheduleEvent->seats_available   = $numberOfSeats->seater ;
            $scheduleEvent->tenant_id         = session()->get('tenant_id');
            $scheduleEvent->save();

            $seatCount = (int) $numberOfSeats->seater;
            for($i = 0 ; $i < $seatCount ; $i++)
            {
                $seatTracker = new \App\Models\SeatTracker();
                $seatTracker->schedule_id = $scheduleEvent->id;
                $seatTracker->bus_id      = (int) $request['busId'];
                $seatTracker->seat_position = $i + 1;
                $seatTracker->save();
            }
            DB::commit();
            return response()->json(['success' => true , 'message' => 'Trip has been scheduled successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false , 'message' => 'Could not save the event .Try again']);

        }
    }


    public function allScheduledTrip()
    {
        return view('Eticket.bus.all-schedule-trip');
    }

    public function fetchAllSchedules(Request $request)
    {
        if ($request->ajax()) {
            $data = EventSchedule::with(['pickup','destination','bus','terminal'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-each-schedule/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function viewEachSchedule($schedule_id)
    {

        $findSchedule = EventSchedule::where('id',$schedule_id)->with(['pickup','destination','bus','terminal'])->first();
        $seatTracker = SeatTracker::where('schedule_id',$schedule_id)->get();


        return view('Eticket.bus.view-schedule', compact('findSchedule', 'seatTracker'));
    }
}
