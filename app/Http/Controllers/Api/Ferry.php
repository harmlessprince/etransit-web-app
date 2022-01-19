<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\FerryLocation;
use App\Models\FerryTrip;
use App\Models\FerryType;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

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
                    ->with('ferry','destination','pickup')->get();

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

        $returnDate = $request->return_date;
        return  response()->json(['success'=>true ,'data' => compact('checkSchedule','tripType','returnDate')]);
    }


    public function selectFerrySeat($ferry_trip_id , $tripType)
    {

        $seats = \App\Models\FerrySeatTracker::where('ferry_trip_id' , $ferry_trip_id)->with('ferryseat')->get();

        return response()->json(['success' => true  , 'data' => compact('seats','tripType')]);
    }

    public function FerrySelectorTracker(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required|integer',
            'tripType'=> 'required|integer'
        ]);

        $seat = \App\Models\FerrySeatTracker::where('id' ,$data['seat_id'])->first();

        if(is_null($seat))
        {
            return response()->json(['success' => false , 'message' => 'Oops seems you picked an empty seat']);
        }
        $tripType = $request->tripType;

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 1,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => true , 'message' => 'Seat Selected successfully']);
        }

        return response()->json(['success' => false , 'message' => 'Seat has already been booked' , 'data' => compact('tripType')]);
    }

    public function deselectFerrySeat(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required'
        ]);

        $seat = \App\Models\FerrySeatTracker::where('id' ,$data['seat_id'])->where('user_id',auth()->user()->id)->first();

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


    public  function bookTripForFerryPassenger(Request $request)
    {
        request()->validate([
            'full_name' => 'required|array',
            'gender' => 'required|array',
            'passenger_option' => 'required|array',
            'tripType' => 'required|integer',
            'ferry_trip_id' => 'required|integer',
            'return_date' => 'sometimes'
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
        $selectedSeat = \App\Models\FerrySeatTracker::where('ferry_trip_id',$request->ferry_trip_id)
                                                             ->where('user_id',auth()->user()->id)
                                                             ->where('booked_status', 1)->get();

        if(!$selectedSeat)
        {
            abort('404');
        }


       $fetchScheduleDetails = \App\Models\FerryTrip::where('id',request()->ferry_trip_id)->first();

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
            $createPassenger                        = new \App\Models\FerryPassenger();
            $createPassenger->full_name             = $request->full_name[$i];
            $createPassenger->gender                = $request->gender[$i];
            $createPassenger->passenger_age_range   = $request->passenger_option[$i];
            $createPassenger->ferry_trip_id         = $fetchScheduleDetails->id;
            $createPassenger->user_id               = auth()->user()->id;
            $createPassenger->ferry_seat_tracker_id = $selectedSeat[$i]->id;
            $createPassenger->save();
        }


        $totalFare = ((double)  $fetchScheduleDetails->amount_adult * (int) $adultCount +  (double) $fetchScheduleDetails->amount_children * (int) $childrenCount ) * (int) $request->tripType;

        $return_date = $request->return_date;

        $tripType = $request->tripType;

        return response()->json(['success' => true ,
           'data' => compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','totalFare','selectedSeat','return_date','tripType') ]);

    }


    public function handleFerryCashPayment(Request $request)
    {
        request()->validate([
            'totalFare'              => 'required',
            'ferry_type_id'          => 'required|integer',
            'service_id'             => 'required|integer',
            'fetchScheduleDetailsID' => 'required',
            'tripType'               => 'required|integer'
        ]);
        DB::beginTransaction();
        $tripSchedule = \App\Models\FerryTrip::where('id', $request->fetchScheduleDetailsID)->select('amount_adult', 'amount_children', 'id', 'number_of_passengers', 'ferry_id')->first();

        $service = \App\Models\Service::where('id', $request->service_id)->first();

        $childrenCount = (int)$request->childrenCount;
        $adultCount = (int) $request->adultCount;

        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->amount = (double) $request->totalFare;

        $transactions->status = 'Pending';
        $transactions->description =  'Cash payment for ' . $service->name . ' by ' . auth()->user()->email . ' at ' . now() ;
        $transactions->user_id =  auth()->user()->id;
        $transactions->service_id = $request->service_id;
        $transactions->ferry_trip_id = $request->ferry_type_id;
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;
        $data["title"] = env('APP_NAME').' Ferry Receipt';
        $data["body"]  = "This is Demo";

        $pdf = PDF::loadView('pdf.car-hire', $data);

        Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "receipt.pdf");
        });

        if ($transactions) {
            //update the status of seat tracker to booked after payment from selected
            //0 = available 1 = selected 2 = booked
            $seatTracker = \App\Models\FerrySeatTracker::where('user_id', auth()->user()->id)
                ->where('ferry_trip_id', $tripSchedule->id)->where('ferry_id', $tripSchedule->ferry_id)->get();

            for ($i = 0; $i < count($seatTracker); $i++) {
                $seatTracker[$i]->update([
                    'booked_status' => 2
                ]);
            }

            //update available seats for this schedule and trip
            $updatedSeatCount = (int)($tripSchedule->number_of_passengers) - ($adultCount + $childrenCount);
            $tripSchedule->update([
                'number_of_passengers' => $updatedSeatCount
            ]);


        }

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Cash Payment made successfully']);

    }
}
