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
                            'return_date'          => 'sometimes',
                            'departure_date'       => 'required|date',
                            'destination_from'     => 'required|integer',
                            'destination_to'       => 'required|integer',
                            'number_of_passengers' => 'required',
                            'trip_type'            => 'required'
                        ]);

            (int)  $data['trip_type'] ==  1  ? $checkSchedule  =  Schedule::withoutGlobalScope()->where('departure_date', $data['departure_date'])
                                                                                  ->where('pickup_id', $data['destination_from'])
                                                                                  ->where('destination_id',$data['destination_to'])
                                                                                  ->where('seats_available' , '>=', $data['number_of_passengers'])
            //                                                                      ->select('fare_adult','terminal_id','bus_id','id',
            //                                                                          'destination_id','pickup_id','fare_children')
                                                                                  ->with(['terminal','destination','pickup','service' ,'tenant','bus' => function($query){
                                                                                                $query->with('tenant')->first();
                                                                                     }])->get()

                                         : $checkSchedule     =  Schedule::withoutGlobalScope()->where('departure_date',$data['departure_date'])
                                                                                          ->where('return_date',$data['return_date'])
                                                                                          ->where('destination_id', $data['destination_to'])
                                                                                          ->where('seats_available' , '>=', $data['number_of_passengers'])
                                                                                          ->where('pickup_id',$data['destination_from'])
                                                                                          ->with(['terminal','tenant','destination','pickup','service','bus' => function($query){
                                                                                          $query->with('tenant')->first();
                                                                                      }])->get();
             if($checkSchedule->isEmpty())
             {
               return response()->json(['success' => false , 'message' => 'We dont\'t have any result for your query at the moment']);
             }

             $tripType = $request->trip_type;
             $returnDate = $request->return_date;

            $operators  = \App\Models\Tenant::inRandomOrder()
                        ->limit(10)
                        ->get();

            $busTypes = \App\Models\BusType::inRandomOrder()
                                                ->limit(10)
                                                ->get();




             return  response()->json(['success'=>true ,'data' => compact('checkSchedule','tripType','returnDate','operators','busTypes')]);
    }

    public function bookingFilterRequest()
    {

        $departureDate = request()->departure_date;

        $checkSchedule =  Schedule::withoutGlobalScope()->where('departure_date', request()->departure_date)
            ->with('terminal','bus','destination','pickup','service','tenant')->get();

        if(!is_null(request()->bus_operator) && request()->trip_type ==  1)
        {

            $checkSchedule =  Schedule::withoutGlobalScope()->where('departure_date', request()->departure_date)
                ->whereIn('tenant_id', request()->bus_operator)
                ->with('terminal','bus','destination','pickup','service','tenant')->get();


        }

        if(!is_null(request()->bus_operator) && !is_null(request()->bus_type) && request()->trip_type ==  1)
        {
            $checkSchedule =  Schedule::withoutGlobalScope()->where('departure_date', request()->departure_date)
                ->whereIn('tenant_id', request()->bus_operator)
                ->with('terminal','destination','pickup','service','tenant','bus')->whereHas('bus', function($query){
                    $query->whereIn('bus_type',request()->bus_type);
                })->get();

        }

        if(!is_null(request()->bus_type) )
        {
            $checkSchedule =  Schedule::withoutGlobalScope()->where('departure_date', request()->departure_date)
                ->with('terminal','destination','pickup','service','tenant','bus')->whereHas('bus', function($query){
                    $query->whereIn('bus_type',request()->bus_type);
                })->get();
        }

        $operators  = \App\Models\Tenant::inRandomOrder()
            ->limit(10)
            ->get();

        $busTypes = \App\Models\BusType::inRandomOrder()
            ->limit(10)
            ->get();

        $tripTypeId = 1;

        return  response()->json(['success'=>true ,'data' => compact('checkSchedule','operators','busTypes','tripTypeId','departureDate')]);

    }


    public function selectSeat($schedule_id, $tripType)
    {

        $seats = \App\Models\SeatTracker::where('schedule_id' , $schedule_id)->get();

        return response()->json(['success' => true  , 'data' => compact('seats','tripType')]);
    }

    public function selectorTracker(Request $request)
    {
           $data = request()->validate([
                'seat_id' => 'required',
                'trip_type' => 'required'
            ]);
        DB::beginTransaction();
        $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->first();

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 1,
                'user_id' => auth()->user()->id,
            ]);


            if((int)$request->trip_type == 2)
            {
                $checkSchedule = $seat->schedule_id;

                $scheduleReturnApp = Schedule::where('id' , $checkSchedule)->first();
                //find unique uuid for return trip
                $uniqueUUIDForReturnTrip = $scheduleReturnApp->return_uuid_tracker;

                $returnTripSchedule = Schedule::where('return_uuid_tracker',$uniqueUUIDForReturnTrip)->where('isReturn','=',1)->first();

                if($returnTripSchedule) {
                    $findReturnScheduleTripSeat = \App\Models\SeatTracker::where('schedule_id', $returnTripSchedule->id)
                        ->where('seat_position', $seat->seat_position)->first();

                    if ($findReturnScheduleTripSeat) {
                        $findReturnScheduleTripSeat->update([
                            'booked_status' => 1,
                            'user_id' => auth()->user()->id
                        ]);
                    }
                }

            }
            DB::commit();
            return response()->json(['success' => true , 'message' => 'Seat Selected successfully']);
        }

        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }

    public function deselectSeat(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required',
            'trip_type' => 'required'
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

            if((int)$request->trip_type == 2)
            {
                $checkSchedule = $seat->schedule_id;

                $scheduleReturnApp = Schedule::where('id', $checkSchedule)->first();

                //find unique uuid for return trip
                $uniqueUUIDForReturnTrip = $scheduleReturnApp->return_uuid_tracker;

                $returnTripSchedule = Schedule::where('return_uuid_tracker', $uniqueUUIDForReturnTrip)->where('isReturn', 1)->first();

                if ($returnTripSchedule) {
                    $findReturnScheduleTripSeat = \App\Models\SeatTracker::where('schedule_id', $returnTripSchedule->id)
                        ->where('seat_position', $seat->seat_position)->first();
                    if ($findReturnScheduleTripSeat) {
                        $findReturnScheduleTripSeat->update([
                            'booked_status' => 0,
                            'user_id' => null
                        ]);
                    }
                }
            }
            return response()->json(['success' => true , 'message' => 'Seat de-selected successfully']);
        }
        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }


    public  function bookTripForPassenger(Request $request , $schedule_id ,$trip_type)
    {
        request()->validate([
            'full_name' => 'required|array',
            'gender' => 'required|array',
            'passenger_option' => 'required|array',
            'tripType' => 'required',
            'return_date' => 'sometimes',
            'next_of_kin_name' => 'required|array',
            'next_of_kin_number' => 'required|array'
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

        if((int)$trip_type == 2)
        {
            $checkSchedule = Schedule::find($schedule_id);
            $scheduleReturnApp = Schedule::where('return_uuid_tracker' , $checkSchedule->return_uuid_tracker)
                                                                            ->where('isReturn','=',1)->first();
            if($scheduleReturnApp)
            {
                $selectedSeatForReturnTrip  = \App\Models\SeatTracker::where('schedule_id',$scheduleReturnApp->id)
                                                                                ->where('user_id',auth()->user()->id)
                                                                                ->where('booked_status', 1)->get();
            }
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

            if((int)$trip_type == 2)
            {
                foreach($selectedSeatForReturnTrip as $unbookedReturnTripSeat)
                {
                    $unbookedReturnTripSeat->update([
                        'booked_status' => 0,
                        'user_id' => null
                    ]);
                }
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

            if((int)$trip_type == 2)
            {
                foreach($selectedSeatForReturnTrip as $unbookedReturnTripSeat)
                {
                    $unbookedReturnTripSeat->update([
                        'booked_status' => 0,
                        'user_id' => null
                    ]);
                }
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
            $createPassenger->next_of_kin_name      = $request->next_of_kin_name[$i];
            $createPassenger->next_of_kin_number    = $request->next_of_kin_number[$i];
            $createPassenger->seat_tracker_id       = $selectedSeat[$i]->id;
            $createPassenger->save();
        }

        if((int)$trip_type == 2)
        {
            for($i = 0 ; $i < $passengerOptionCount ; $i++)
            {
                $createPassenger                        = new \App\Models\Passenger();
                $createPassenger->full_name             = $request->full_name[$i];
                $createPassenger->gender                = $request->gender[$i];
                $createPassenger->passenger_age_range   = $request->passenger_option[$i];
                $createPassenger->schedule_id           = $scheduleReturnApp->id;
                $createPassenger->next_of_kin_name      = $request->next_of_kin_name[$i];
                $createPassenger->next_of_kin_number    = $request->next_of_kin_number[$i];
                $createPassenger->user_id               = auth()->user()->id;
                $createPassenger->seat_tracker_id       = $selectedSeatForReturnTrip[$i]->id;
                $createPassenger->save();
            }
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
            'tripType' => 'required'
        ]);

        //find the schedule to get the actual amount stored in the database
        $tripSchedule = \App\Models\Schedule::where('id', $attr['schedule_id'])
                                         ->select('fare_adult', 'fare_children', 'id', 'seats_available', 'bus_id','return_uuid_tracker')->first();

        !$tripSchedule ? abort('404') : '';

        $adultFare = (double)$tripSchedule->fare_adult;

        $childrenFare = (double)$tripSchedule->fare_children;

        $tripType = request()->tripType;

        if ((int)$tripType == 2)
        {
            $type = 2;

            $scheduleReturnApp = Schedule::where('return_uuid_tracker' , $tripSchedule->return_uuid_tracker)->where('isReturn','=',1)->first();

            if($scheduleReturnApp)
            {
                $selectedSeatForReturnTrip  = \App\Models\SeatTracker::where('schedule_id',$scheduleReturnApp->id)
                    ->where('user_id',auth()->user()->id)
                    ->where('booked_status', 1)->get();
            }

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

            if($tripType == 2)
            {
                for($i = 0 ; $i < count($selectedSeatForReturnTrip); $i++)
                {
                    $selectedSeatForReturnTrip[$i]->update([
                        'booked_status' => 2
                    ]);
                }

                $updatedSeatCountForReturnTrip = (int) ($scheduleReturnApp->seats_available) -  ($attr['adultCount'] + $attr['childrenCount']);

                $scheduleReturnApp->update([
                    'seats_available' => $updatedSeatCountForReturnTrip
                ]);
            }


        }
        DB::commit();

        $data["email"] =  auth()->user()->email;

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Bus Booking',
            'transaction' => $transactions,
            'seatTrackers' => $seatTracker,
            'adultFare' => $adultFare,
            'childFare'=>$childrenFare,
            'tripType' => $tripType,
            'adultCount' => $attr['adultCount'],
            'childrenCount' => $attr['childrenCount'],
            'tripSchedule' => $tripSchedule,
            'totalAmount' => $attr['amount'],
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new BusBooking($maildata));

        return  response()->json(['success' => true , 'message' =>  'cash payment made successfully']);
    }
}
