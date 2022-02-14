<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Mail\BusBooking;
use App\Models\TripType;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class Booking extends Controller
{
    public function bookingForService(Service $service)
    {
       !$service ? abort(404) : $serviceID = $service['id'];

       $tripTypes = TripType::all();
       $destinations = Destination::all();
       $pickups = \App\Models\Pickup::all();

       return response()->json(['success' => true , 'data' => compact('serviceID','tripTypes','destinations','pickups')]);
    }


    public function bookTrip(Request $request)
    {

        $data = request()->validate([
                            'service_id'           => 'required',
                            'return_date'          => 'sometimes|date',
                            'departure_date'       => 'required|date',
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
                                                                      ->with(['terminal','destination','pickup','service' ,'bus' => function($query){
                                                                                    $query->with('tenant')->first();
                                                                         }])->get()

                                         : $checkSchedule =  Schedule::where('departure_date',$data['departure_date'])
                                                                       ->where('return_date',$data['return_date'])
                                                                        ->where('destination_id', $data['destination_to'])
                                                                         ->where('seats_available' , '>=', $data['number_of_passengers'])
                                                                        ->where('pickup_id',$data['destination_from'])
                                                                      ->with(['terminal','destination','pickup','service','bus' => function($query){
                                                                          $query->with('tenant')->first();
                                                                      }])->get();
             if($checkSchedule->isEmpty())
             {
               return response()->json(['success' => false , 'message' => 'We dont\'t have any result for your query at the moment']);
             }

             $tripType = $request->trip_type;
             $returnDate = $request->return_date;

             return  response()->json(['success'=>true ,'data' => compact('checkSchedule','tripType','returnDate')]);
    }


    public function selectSeat($schedule_id)
    {

        $seats = \App\Models\SeatTracker::where('schedule_id' , $schedule_id)->get();

        return response()->json(['success' => true  , 'data' => compact('seats')]);
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
                'user_id' => auth()->user()->id,
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

        $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->where('user_id',auth()->user()->id)->first();

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
            'passenger_option' => 'required|array',
            'tripType' => 'required',
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


        $totalFare = ((double)  $fetchScheduleDetails->fare_adult * (int) $adultCount +  (double) $fetchScheduleDetails->fare_children * (int) $childrenCount) * (int) abs($request->tripType);

        $returnDate = $request->return_date;

        return response()->json(['success' => true ,
           'data' =>  compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','totalFare','selectedSeat', 'returnDate') ]);

    }

    public function handleBusCashPayment(Request $request)
    {
        $attr  = request()->validate([
            'amount' => 'required',
            'service_id' => 'required|integer',
            'schedule_id' => 'required|integer',
            'childrenCount' => 'required|integer',
            'adultCount' => 'required|integer',
        ]);

        //find the schedule to get the actual amount stored in the database
        $tripSchedule = \App\Models\Schedule::where('id', $attr['schedule_id'])
                                         ->select('fare_adult', 'fare_children', 'id', 'seats_available', 'bus_id')->first();

        !$tripSchedule ? abort('404') : '';

        $adultFare = (double)$tripSchedule->fare_adult;

        $childrenFare = (double)$tripSchedule->fare_children;

        $tripType = request()->tripType;

        if ((int)$tripType == 2)
        {
            $type = 2;
        } else {
            $type = 1;
        }

       // $amount = (double) $request->amount  * (int) $type;
        DB::beginTransaction();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->amount =  $request->amount;
        $transactions->status = 'Successful';
        $transactions->schedule_id = $attr['schedule_id'];
        $transactions->description = 'Cash payment  of ' .  $request->amount  .' was paid at ' . now();
        $transactions->user_id = auth()->user()->id;
        $transactions->passenger_count = $attr['adultCount'] + $attr['childrenCount'];
        $transactions->service_id = $attr['service_id'];
        $transactions->tenant_id = $tripSchedule->bus->tenant->id;
        $transactions->isConfirmed = 'False';
        $transactions->save();

        if ($transactions) {
            //update the status of seat tracker to booked after payment from selected
            //0 = available 1 = selected 2 = booked
            $seatTracker = \App\Models\SeatTracker::where('user_id', auth()->user()->id)
                ->where('schedule_id', $attr['schedule_id'])->where('bus_id', $tripSchedule->bus_id)->get();

            for ($i = 0; $i < count($seatTracker); $i++) {
                $seatTracker[$i]->update([
                    'booked_status' => 2
                ]);
            }

            //update available seats for this schedule and trip
            $updatedSeatCount = (int)($tripSchedule->seats_available) - ($attr['adultCount'] + $attr['childrenCount']);
            $tripSchedule->update([
                'seats_available' => $updatedSeatCount
            ]);


        }
        DB::commit();

        $data["email"] =  auth()->user()->email;

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Bus Booking',
            'transaction' => $transactions
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new BusBooking($maildata));

        return  response()->json(['success' => true , 'message' =>  'cash payment made successfully']);
    }
}
