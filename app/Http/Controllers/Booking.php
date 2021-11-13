<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class Booking extends Controller
{
    public function bookingRequest(Request $request)
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
            ->with('terminal','bus','destination','pickup','service')->get()

            : $checkSchedule =  Schedule::where('departure_date',$data['departure_date'])
            ->where('return_date',$data['return_date'])
            ->where('destination_id', $data['destination_from'])
            ->where('seats_available' , '>=', $data['number_of_passengers'])
            ->where('pickup_id',$data['destination_to'])->get();


        //fetch destination and pick up
        $pickUp = \App\Models\Destination::where('id',$data['destination_from'])->select('location')->first();
        $destination = \App\Models\Destination::where('id',$data['destination_to'])->select('location')->first();

        //fetch trip type
        $tripType = \App\Models\TripType::where('id',$data['trip_type'])->select('type')->first();

        $service = \App\Models\Service::where('id',$data['service_id'])->select('name')->first();

        return view('pages.booking.booking', compact('checkSchedule','data' ,'tripType', 'service' ,'destination' ,'pickUp'));
    }


    public function seatSelector($schedule_id)
    {
        $fetchSeats = \App\Models\SeatTracker::where('schedule_id' ,$schedule_id)
                                        ->select('seat_position','id','booked_status')->get();


        return view('pages.booking.seat-picker' , compact('fetchSeats' ,'schedule_id'));
    }

    public function selectorTracker(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required'
        ]);

      $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->first();

       if($seat->booked_status != 2)
       {
           $seat->update([
               'booked_status' => 1,
               'user_id' => $request->user_id
           ]);
           return response()->json(['success' => true , 'message' => 'Seat Selected successfully']);
       }

        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);

    }

    public function deselectSeat(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required'
        ]);

        $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->where('user_id',$request->user_id)->first();

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 0,
                'user_id' => null
            ]);
            return response()->json(['success' => true , 'message' => 'Seat de-selected successfully']);
        }
        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }

    public  function bookTrip(Request $request , $schedule_id)
    {
         request()->validate([
                    'full_name' => 'required|array',
                    'gender' => 'required|array',
//                            'passenger_options' => 'required|array'
                ]);

         $passengerArray = [];
         $passengers = $request->full_name;
         foreach($passengers as $passenger)
         {
             if($passenger != null)
             {
                 array_push($passengerArray ,$passenger);
             }
         }

         $passengerCount = count($passengerArray);
         //find if the seats selected matches the number of passengers listed
         $selectedSeat = \App\Models\SeatTracker::where('schedule_id',$schedule_id)
                                                            ->where('user_id',auth()->user()->id)
                                                            ->where('booked_status', 1)->get();

        if($passengerCount != count($selectedSeat))
        {

            foreach($selectedSeat as $unbookedseat)
            {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'user_id' => null
                ]);
            }
            return 'number of seat selected is more than the passenger count';
        }

        return view('pages.payment.payment-page');

    }
}
