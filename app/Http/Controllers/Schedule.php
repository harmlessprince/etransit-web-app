<?php

namespace App\Http\Controllers;

use App\Exports\ScheduleExport;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Schedule as EventSchedule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Schedule extends Controller
{
    public function scheduleEvent(Request $request ,$bus_id)
    {
         $bus =  Bus::where('id',$bus_id)->first();
         $terminals = \App\Models\Terminal::all();
         $locations  = \App\Models\Destination::all();
         $pickups    = \App\Models\Pickup::all();

        if($request->ajax()) {
            $data = EventSchedule::whereDate('departure_date', '>=', $request->start)
//                ->whereDate('return_date',   '<=', $request->end)
                ->get(['id', 'pickup_id', 'destination_id', 'fare_adult','departure_date']);
            return response()->json($data);
        }



         return view('admin.schedule.event' , compact('terminals','bus','locations','pickups'));

    }

    public function addEvent(Request $request)
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
                        $scheduleEvent->seats_available   = $numberOfSeats->seater ;
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
                return response()->json(['success' => true , 'message' => 'Event has been scheduled successfully']);
                } catch (\Exception $e) {
                    DB::rollback();
//                        return $e->getMessage();
                    return response()->json(['success' => false , 'message' => 'Could not save the event .Try again']);

                }
    }


    public function importExportViewSchedule()
    {
        return view('admin.schedule.import');
    }

    public function exportSchedule()
    {
//        $schedules = EventSchedule::with('terminal','bus',
//            'pickup','destination','service')->select('terminal_id',
//            'pickup_id','destination_id','service_id','fare_adult','fare_children'
//            ,'departure_date','departure_time')->get();

     $schedules =   DB::table('schedules')->select('terminal_name','name','car_type','pickups.location as pickup','destinations.location','fare_adult','fare_children','departure_date','departure_time')
         ->join('terminals', 'schedules.terminal_id', '=', 'terminals.id')
         ->join('services', 'schedules.service_id', '=', 'services.id')
         ->join('buses', 'schedules.bus_id', '=', 'buses.id')
         ->join('pickups', 'schedules.pickup_id', '=', 'pickups.id')
         ->join('destinations', 'schedules.destination_id', '=', 'destinations.id')
         ->get();


        return Excel::download(new ScheduleExport( $schedules), 'schedule.xlsx');
    }

}
