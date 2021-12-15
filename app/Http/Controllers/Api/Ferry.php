<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FerryLocation;
use App\Models\FerryTrip;
use App\Models\FerryType;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\TripType;
use Illuminate\Http\Request;

class Ferry extends Controller
{
    public function ferryService()
    {
        $service = Service::where('id', 3)->firstorfail();
        $tripType = TripType::all();

        $ferryTypes = FerryType::all();
        $locations = FerryLocation::all();


        return response()->json(['success' => true , 'data' => compact('service','ferryTypes','locations','tripType')]);
    }


    public function bookFerry(Request $request)
    {

        $data = request()->validate([
            'service_id'           => 'required',
            'return_date'          => 'sometimes|date',
            'departure_date'       => 'required|date',
            'destination_from'     => 'required|integer',
            'destination_to'       => 'required|integer',
            'number_of_passengers' => 'required',
            'trip_type'            => 'required',
            'ferry_type_id'       => 'required|integer'
        ]);

         $checkSchedule =  FerryTrip::where('event_date', $data['departure_date'])
                    ->where('ferry_pick_up_id', $data['destination_from'])
                    ->where('ferry_destination_id',$data['destination_to'])
                    ->where('ferry_type_id',$data['ferry_type_id'])
                    ->where('number_of_passengers' , '>=', $data['number_of_passengers'])
                    ->with('ferry','destination','pickup','service')->get();

         $tripType = $request->trip_type;

//            : $checkSchedule =  FerryTrip::where('event_date',$data['departure_date'])
//                ->where('ferry_pick_up_id', $data['destination_from'])
//                ->where('ferry_destination_id',$data['destination_to'])
//                ->where('ferry_type_id',$data['ferry_type_id'])
//                ->where('number_of_passengers' , '>=', $data['number_of_passengers'])
//                ->with('ferry','destination','pickup','service')->get();

        if($checkSchedule->isEmpty())
        {
            return response()->json(['success' => false , 'message' => 'We dont\'t have any result for your query at the moment']);
        }

        return  response()->json(['success'=>true ,'data' => compact('checkSchedule','tripType')]);
    }


    public function selectFerrySeat($ferry_id)
    {

        $seats = \App\Models\FerrySeat::where('id' , $ferry_id)->get();

        return response()->json(['success' => true  , 'data' => compact('seats')]);
    }

    public function FerrySelectorTracker(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required'
        ]);

        $seat = \App\Models\FerrySeat::where('id' ,$data['seat_id'])->first();

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 1,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => true , 'message' => 'Seat Selected successfully']);
        }

        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }

    public function deselectFerrySeat(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required'
        ]);

        $seat = \App\Models\FerrySeat::where('id' ,$data['seat_id'])->where('user_id',auth()->user()->id)->first();

        if(is_null($seat))
        {
            return response()->json(['success' => false , 'message' => 'You can only unselect already selected seat']);
        }

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


    public  function bookTripForPassenger(Request $request , $schedule_id)
    {
        request()->validate([
            'full_name' => 'required|array',
            'gender' => 'required|array',
            'passenger_option' => 'required|array'
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

        $passenger_options = $request['passenger_option'];
        $passengerOptionCount = count($passenger_options);
        $passengerCount = count($passengerArray);
        //find if the seats selected matches the number of passengers listed
        $selectedSeat = \App\Models\SeatTracker::where('schedule_id',$schedule_id)
            ->where('user_id',auth()->user()->id)
            ->where('booked_status', 1)->get();

        if(!$selectedSeat)
        {
            abort('404');
        }


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

            return  response()->json(['success' => false , 'message' => 'Number of seats selected must match the passenger count' ]);
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
            return  response()->json(['success' => false , 'message' => 'Please ensure the gender option is not more than the number of passenger intended for booking' ]);
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


        $totalFare = (double)  $fetchScheduleDetails->fare_adult * (int) $adultCount +  (double) $fetchScheduleDetails->fare_children * (int) $childrenCount;

        return response()->json(['success' => true ,
            compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','totalFare','selectedSeat') ]);

    }
}
