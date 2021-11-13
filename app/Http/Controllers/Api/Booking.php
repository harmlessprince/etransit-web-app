<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TripType;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Destination;

class Booking extends Controller
{
    public function bookingForService(Service $service)
    {
       !$service ? abort(404) : $serviceID = $service['id'];

       $tripTypes = TripType::all();

       $destinations = Destination::all();

       return response()->json(['success' => true , 'data' => compact('serviceID','tripTypes','destinations')]);
    }


    public function bookTrip(Request $request)
    {
        $data = request()->validate([
                            'service_id'           => 'required',
                            'return_date'          => 'sometimes',
                            'departure_date'       => 'required',
                            'destination_from'     => 'required|integer',
                            'destination_to'       => 'required|integer',
                            'number_of_passengers' => 'required',
                            'trip_type'            => 'required'
                        ]);

            (int)  $data['trip_type'] ==  1  ? $checkSchedule =  Schedule::where('departure_date', $data['departure_date'])
                                                                      ->where('pickup_id', $data['destination_from'])
                                                                      ->where('destination_id',$data['destination_to'])
                                                                      ->where('seats_available' , '>=', $data['number_of_passengers'])
//                                                                      ->select('fare_adult','terminal_id','bus_id','id',
//                                                                          'destination_id','pickup_id','fare_children')
                                                                      ->with('terminal','bus','destination','pickup','service')->get()

                                         : $checkSchedule =  Schedule::where('departure_date',$data['departure_date'])
                                                                        ->where('return_date',$data['return_date'])
                                                                        ->where('destination_id', $data['destination_from'])
                                                                         ->where('seats_available' , '>=', $data['number_of_passengers'])
                                                                        ->where('pickup_id',$data['destination_to'])->get();
             if($checkSchedule->isEmpty())
             {
               return response()->json(['success' => false , 'message' => 'We dont\'t have any result for your query at the moment']);
             }

             return  response()->json(['success'=>true ,'data' => compact('checkSchedule')]);
    }


    public function selectSeat($schedule_id)
    {

        $seats = \App\Models\SeatTracker::where('schedule_id' , $schedule_id)->get();

        return response()->json(['success' => true  , 'data' => compact('seats')]);
    }

    public function selectorTracker(Request $request)
    {
           $data = request()->validate([
                'seat_id' => 'required|array'
            ]);

           return count($data['seat_id']);
    }
}
