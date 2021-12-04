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
            'trip_type'            => 'required',
        ]);


        $data['return_date'] != null ? $request->session()->put('return_date', $data['return_date']) : $returnDate = null;

        //ensure the query does not return a data if the date the user picked has passed
        //to avoid booking a ride that has already passed or left

//        (int)  $data['trip_type'] ==  1  ? $checkSchedule =  Schedule::where('departure_date', $data['departure_date'])
////            ->whereDate('departure_date','>=', $data['departure_date'])
//            ->where('pickup_id', $data['destination_from'])
//            ->where('destination_id',$data['destination_to'])
//            ->where('seats_available' , '>=', $data['number_of_passengers'])
//            ->with('terminal','bus','destination','pickup','service')->get()
//
//            : $checkSchedule =  Schedule::where('departure_date',$data['departure_date'])
//            ->where('return_date',$data['return_date'])
//            ->where('destination_id', $data['destination_from'])
//            ->where('seats_available' , '>=', $data['number_of_passengers'])
//            ->where('pickup_id',$data['destination_to'])->get();

        $checkSchedule =  Schedule::where('departure_date', $data['departure_date'])
                                            ->where('pickup_id', $data['destination_from'])
                                            ->where('destination_id',$data['destination_to'])
                                            ->where('seats_available' , '>=', $data['number_of_passengers'])
                                            ->with('terminal','bus','destination','pickup','service')->get();

        //fetch destination and pick up
        $pickUp = \App\Models\Destination::where('id',$data['destination_from'])->select('location')->first();
        $destination = \App\Models\Destination::where('id',$data['destination_to'])->select('location')->first();

        //find the type of trip
         $tripType = \App\Models\TripType::where('id',$data['trip_type'])->select('type','id')->first();

        !$tripType ? abort(404) : $request->session()->put('tripType', $data['trip_type']);

         $service = \App\Models\Service::where('id',$data['service_id'])->select('name')->first();

        return view('pages.booking.booking', compact('checkSchedule','data' ,'tripType',
            'service' ,'destination' ,'pickUp'));
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
                    'passenger_options' => 'required|array'
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
        //find if the seats selected matches the number of passengers listed
        $selectedSeat = \App\Models\SeatTracker::where('schedule_id',$schedule_id)
            ->where('user_id',auth()->user()->id)
            ->where('booked_status', 1)->get();

         $passenger_options = $request['passenger_option'];

         if(is_null($passenger_options))
         {

             foreach($selectedSeat as $unbookedseat)
             {
                 $unbookedseat->update([
                     'booked_status' => 0,
                     'user_id' => null
                 ]);
             }
             toastr()->error('Please select passenger age range option');
             return back();
         }


        $passengerOptionCount = count($passenger_options);
        $passengerCount = count($passengerArray);

         $fetchScheduleDetails = \App\Models\Schedule::where('id',$schedule_id)->with('service','bus','destination','pickup','terminal')->first();

        if($passengerCount != count($selectedSeat))
        {

            foreach($selectedSeat as $unbookedseat)
            {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'user_id' => null
                ]);
            }
            toastr()->error('Number of seats selected must match the passenger count');
            return  back();
        }

        if($passengerCount != $passengerOptionCount)
        {

            foreach($selectedSeat as $unbookedseat)
            {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'user_id' => null
                ]);
            }
            toastr()->error('Please ensure the gender option is not more than the number of passenger intended for booking');
            return  back();
        }else{

            $adult = [];
            $children = [];
            foreach($passenger_options as $passenger_option)
            {
                if(strtolower($passenger_option) == 'adult')
                {
                    array_push($adult , $passenger_option);
                }elseif (strtolower($passenger_option) == 'children')
                {
                    array_push($children , $passenger_option);
                }

            }
        }

        $adultCount = count($adult);
        $childrenCount = count($children);

        for($i = 0 ; $i < $passengerOptionCount ; $i++)
        {
            $createPassenger                        = new \App\Models\Passenger();
            $createPassenger->full_name             = $request->full_name[$i];
            $createPassenger->gender                = $request->gender[$i];
            $createPassenger->passenger_age_range   = $request->passenger_option[$i];
            $createPassenger->schedule_id           = $schedule_id;
            $createPassenger->user_id               = auth()->user()->id;
            $createPassenger->seat_tracker_id       = $selectedSeat[$i]->id;
            $createPassenger->save();
        }

        $returnDate = request()->session()->get('return_date');
        $tripType = request()->session()->get('tripType');

        $totalFare = ((double)  $fetchScheduleDetails->fare_adult * (int) $adultCount +
                     (double) $fetchScheduleDetails->fare_children * (int) $childrenCount) * (int) $tripType;

        if((int) $tripType == 2 )
        {
            $returnDate  = date('d:M:Y ',strtotime($returnDate)) ;
        } else{
            $returnDate = null;
        }

        return view('pages.payment.payment-page',
            compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','totalFare','selectedSeat','returnDate'));

    }
}
