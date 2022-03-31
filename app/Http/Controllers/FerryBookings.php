<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use App\Models\FerryTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FerryBookings extends Controller
{

    public function bookFerry(Request $request)
    {

        $data = request()->validate([
            'service_id'           => 'required',
            'return_date'          => 'sometimes',
            'departure_date'       => 'required|date',
            'destination_from'     => 'required|integer',
            'destination_to'       => 'required|integer',
            'number_of_passengers' => 'required',
            'ferry_type'      => 'required',
            'ferry_trip_type_id'   => 'required|integer'
        ]);
        $tripType = $request->ferry_trip_type_id;



        if($tripType == 1)
        {
            $checkSchedule =  FerryTrip::where('event_date', $data['departure_date'])
                ->where('ferry_pick_up_id', $data['destination_from'])
//                ->where('ferry_destination_id',$data['destination_to'])
                ->where('ferry_type_id',$data['ferry_type'])
                ->where('number_of_passengers' , '>=', $data['number_of_passengers'])
                ->with('ferry','destination','pickup')->get();
        }else{

            $checkSchedule =  FerryTrip::where('event_date',$data['departure_date'])
                ->where('ferry_pick_up_id', $data['destination_from'])
                ->where('ferry_destination_id',$data['destination_to'])
                ->where('ferry_type_id',$data['ferry_type'])
                ->where('number_of_passengers' , '>=', $data['number_of_passengers'])
                ->with('ferry','destination','pickup')->get();
        }

        $returnDate = $request->return_date;

        return  view('pages.ferry.schedules' ,compact('checkSchedule','tripType','returnDate'));
    }


    public function selectFerrySeat($ferry_trip_id , $tripType)
    {

        $seats = \App\Models\FerrySeatTracker::where('ferry_trip_id' , $ferry_trip_id)->with('ferryseat')->get();


        return view('pages.ferry.view-seat', compact('seats','tripType','ferry_trip_id'));
    }

    public function FerrySelectorTracker(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required|integer',
            'trip_type'=> 'required|integer'
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
            'seat_id' => 'required',
            'trip_type' => 'required'
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
            toastr()->error('Number of seats selected must match the passenger count');
            return back();
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
            return back();
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


      $actualSeats = [];

      foreach($selectedSeat as $seat){
          $seat = \App\Models\FerrySeat::where('id' , $seat->ferry_seat_id)->first();
          $coachType = $seat->coach_type;
          $coachNumber = $seat->coach_number;
          $seatNumber = Ucfirst($coachType) . $coachNumber ;
          array_push($actualSeats , $seatNumber);
      }

      $ferry_trip_id = request()->ferry_trip_id;

        return view('pages.ferry.payment', compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','totalFare','selectedSeat','return_date','tripType','actualSeats','ferry_trip_id'));

    }


    public function handleFerryCashPayment(Request $request)
    {


//        request()->validate([
//            'totalFare'              => 'required',
//            'ferry_type_id'          => 'required|integer',
//            'service_id'             => 'required|integer',
//            'fetchScheduleDetailsID' => 'required',
//            'tripType'               => 'required|integer'
//        ]);

        DB::beginTransaction();
        $tripSchedule = \App\Models\FerryTrip::where('id', $request->fetchScheduleDetailsID)
                                        ->select('amount_adult', 'amount_children', 'id', 'number_of_passengers', 'ferry_id')
                                        ->first();

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
        $transactions->isConfirmed = 'False';
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Ferry Booking',
            'transaction' => $transactions
        ];

        $email = $data["email"];

        Mail::to($email)->send(new \App\Mail\FerryBookings($maildata));

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

        toastr()->success('Cash Payment made successfully');

        return redirect('/');


    }
}
