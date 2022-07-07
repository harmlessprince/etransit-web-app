<?php

namespace App\Http\Controllers;

use App\Classes\Invoice;
use App\Classes\Reference;
use App\Mail\BusBooking;
use App\Models\Schedule;
use App\Models\SeatTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class Booking extends Controller
{
    public function bookingRequest(Request $request)
    {

        if(!$request->expectsJson())
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
        }



        $request->return_date != null ? $request->session()->put('return_date', $request->return_date) : $returnDate = null;

        //ensure the query does not return a data if the date the user picked has passed
        //to avoid booking a ride that has already passed or left

//        (int)  $data['trip_type'] ==  1  ? $checkSchedule =  Schedule::where('departure_date', $data['departure_date'])
//                                               //  ->whereDate('departure_date','>=', $data['departure_date'])
//                                                ->where('pickup_id', $data['destination_from'])
//                                                ->where('destination_id',$data['destination_to'])
//                                                ->where('seats_available' , '>=', $data['number_of_passengers'])
//                                                ->with('terminal','bus','destination','pickup','service')->get()
//
//                                                : $checkSchedule =  Schedule::where('departure_date',$data['departure_date'])
//                                                ->where('return_date',$data['return_date'])
//                                                ->where('destination_id', $data['destination_to'])
//                                                ->where('seats_available' , '>=', $data['number_of_passengers'])
//                                                ->where('pickup_id',$data['destination_from'])
//                                                 ->with('terminal','bus','destination','pickup','service')->get();
////
        if($request->trip_type ==  1 )
        {
            $checkSchedule =  Schedule::withoutGlobalScopes()->where('departure_date', $request->departure_date)
                //  ->whereDate('departure_date','>=', $data['departure_date'])
                ->where('pickup_id', $request->destination_from)
                ->where('destination_id',$request->destination_to)
                ->where('seats_available' , '>=', $request->number_of_passengers)
                ->with('terminal','bus','destination','pickup','service','tenant')->get();

        }elseif($request->trip_type ==  2)
        {
            $checkSchedule =  Schedule::withoutGlobalScopes()->where('departure_date',$request->departure_date)
                ->where('return_date',$request->return_date)
                ->where('destination_id', $request->destination_to)
                ->where('seats_available' , '>=', $request->number_of_passengers)
                ->where('pickup_id',$request->destination_from)
                ->with('terminal','bus','destination','pickup','service','tenant')->get();
        }

        if(!is_null(request()->bus_operator) && $request->trip_type ==  1)
        {
            $checkSchedule =  Schedule::withoutGlobalScopes()->where('departure_date', $request->departure_date)
                ->whereIn('tenant_id', request()->bus_operator)
                //  ->whereDate('departure_date','>=', $data['departure_date'])
                ->where('pickup_id', $request->destination_from)
                ->where('destination_id',$request->destination_to)
                ->where('seats_available' , '>=', $request->number_of_passengers)
                ->with('terminal','bus','destination','pickup','service','tenant')->get();
        }


        $operators  = \App\Models\Tenant::inRandomOrder()
                                                ->limit(10)
                                                ->get();

        $busTypes = \App\Models\BusType::inRandomOrder()
                                                ->limit(10)
                                                ->get();
//        dd( $busTypes );


//        $checkSchedule =  Schedule::where('departure_date', $data['departure_date'])
//                                            ->where('pickup_id', $data['destination_from'])
//                                            ->where('destination_id',$data['destination_to'])
//                                            ->where('seats_available' , '>=', $data['number_of_passengers'])
//                                            ->with('terminal','bus','destination','pickup','service')->get();


         //check if the departure date has not already passed
        if($request->departure_date < now()->format('Y-m-d'))
        {
            toastr()->error('Error !! You can\'t pick a departure date that has already passed');

            return back();
        }

        //fetch destination and pick up
        $pickUp = \App\Models\Destination::where('id',$data['destination_from'])->select('location')->first();
        $destination = \App\Models\Destination::where('id',$data['destination_to'])->select('location')->first();

        //find the type of trip
         $tripType = \App\Models\TripType::where('id',$data['trip_type'])->select('type','id')->first();

        !$tripType ? abort(404) : $request->session()->put('tripType', $data['trip_type']);

         $service = \App\Models\Service::where('id',$data['service_id'])->select('name')->first();

         $tripTypeId = $data['trip_type'];


        return view('pages.booking.booking', compact('checkSchedule','data' ,'tripType',
            'service' ,'destination' ,'pickUp','tripTypeId','operators','busTypes'));
    }


    public function bookingFilterRequest()
    {


        $nowDate = now()->format('Y-m-d');

        $departureDate = request()->departure_date;

        if(!is_null(request()->bus_operator))
        {
            $checkSchedule =  Schedule::withoutGlobalScopes()->whereIn('tenant_id', request()->bus_operator)
                ->whereDate('departure_date','>=',$nowDate)
                ->with('terminal','bus','destination','pickup','service','tenant')->get();
        }




        if(!is_null(request()->bus_operator) && request()->trip_type ==  1)
        {

            $checkSchedule =  Schedule::withoutGlobalScopes()->whereDate('departure_date','>=',$nowDate)
                ->whereIn('tenant_id', request()->bus_operator)
                ->with(['terminal','bus','destination','pickup','service','tenant' ,'bus' => function($query){
                    $query->withoutGlobalScopes()->get();
                }])->with(['terminal' => function($query){
                    $query->withoutGlobalScopes()->get();
                }])->get();


        }

        if(!is_null(request()->bus_operator) && !is_null(request()->bus_type) && request()->trip_type ==  1)
        {
            $checkSchedule =  Schedule::withoutGlobalScopes()->whereDate('departure_date','>=',$nowDate)
                ->whereIn('tenant_id', request()->bus_operator)
                ->with('terminal','tenant','destination','pickup','service','bus')->whereHas('bus', function($query){
                    $query->withoutGlobalScopes()->whereIn('bus_type',request()->bus_type)->get();
                })->with(['tenant','destination','pickup','service','terminal'=> function($query){
                    $query->withoutGlobalScopes()->get();
                }])->get();

        }

        if(!is_null(request()->bus_type) )
        {

            $checkSchedule =  Schedule::withoutGlobalScopes()->whereDate('departure_date','>=',$nowDate)
                ->with(['terminal','tenant','destination','pickup','service','bus' => function($query){
                    $query->withoutGlobalScopes()->whereIn('bus_type',request()->bus_type)->get();
                }])->with(['tenant','destination','pickup','service','terminal'=> function($query){
                    $query->withoutGlobalScopes()->get();
                }])->get();



        }


        $operators  = \App\Models\Tenant::inRandomOrder()
            ->limit(10)
            ->get();

        $busTypes = \App\Models\BusType::inRandomOrder()
            ->limit(10)
            ->get();

        $tripTypeId = 1;

        return view('pages.booking.filter', compact('checkSchedule','operators','busTypes','tripTypeId','departureDate'));
    }





    public function seatSelector($schedule_id , $tripType)
    {

       $fetchSeats = \App\Models\SeatTracker::where('schedule_id' ,$schedule_id)
                                        ->select('seat_position','id','booked_status')->get();

        return view('pages.booking.seat-picker' , compact('fetchSeats' ,'schedule_id','tripType'));
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
                'user_id' => $request->user_id
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
                                'user_id' => $request->user_id
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

        if(!isset($request->onsite_customer_id)) $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->where('user_id',$request->user_id)->first();

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 0,
                'user_id' => null,
                'onsite_customer_id' => null
            ]);

            if((int)$request->trip_type == 2)
            {
                $checkSchedule = $seat->schedule_id;

                $scheduleReturnApp = Schedule::where('id' , $checkSchedule)->first();

                //find unique uuid for return trip
                $uniqueUUIDForReturnTrip = $scheduleReturnApp->return_uuid_tracker;

                $returnTripSchedule = Schedule::where('return_uuid_tracker',$uniqueUUIDForReturnTrip)->where('isReturn',1)->first();

                if($returnTripSchedule)
                {
                    $findReturnScheduleTripSeat = \App\Models\SeatTracker::where('schedule_id', $returnTripSchedule->id)
                        ->where('seat_position', $seat->seat_position)->first();
                    if($findReturnScheduleTripSeat)
                    {
                        $findReturnScheduleTripSeat->update([
                            'booked_status' => 0,
                            'user_id' => null,
                            'onsite_customer_id'=> null
                        ]);
                    }
                }

            }
            return response()->json(['success' => true , 'message' => 'Seat de-selected successfully']);
        }
        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }


    public  function bookTrip(Request $request , $schedule_id ,$trip_type)
    {
         request()->validate([
                    'full_name' => 'required|array',
                    'gender' => 'required|array',
                    'passenger_option' => 'required|array',
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

        //find if the seats selected matches the number of passengers listed
        $selectedSeat = SeatTracker::where('schedule_id',$schedule_id)
                                            ->where('user_id',auth()->user()->id)
                                            ->where('booked_status', 1)->get();

        if((int)$trip_type == 2)
        {
            $checkSchedule = Schedule::find($schedule_id);


            $scheduleReturnApp = Schedule::where('return_uuid_tracker' , $checkSchedule->return_uuid_tracker)->where('isReturn','=',1)->first();


            if($scheduleReturnApp)
            {
                $selectedSeatForReturnTrip  = \App\Models\SeatTracker::where('schedule_id',$scheduleReturnApp->id)
                                                                    ->where('user_id',auth()->user()->id)
                                                                    ->where('booked_status', 1)->get();
            }
        }


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

             toastr()->error('Please select passenger age range option');
             return back();
         }


        $passengerOptionCount = count($passenger_options);
        $passengerCount = count($passengerArray);

         $fetchScheduleDetails = Schedule::where('id',$schedule_id)->with('service','bus','destination','pickup','terminal')->first();

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
            $createPassenger->next_of_kin_name      = $request->next_of_kin_name[$i];
            $createPassenger->next_of_kin_number    = $request->next_of_kin_number[$i];
            $createPassenger->user_id               = auth()->user()->id;
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


    public function handleBusCashPayment(Request $request)
    {

            $attr  = request()->validate([
                        'amount' => 'required',
                        'service' => 'required',
                        'service_id' => 'required|integer',
                        'schedule_id' => 'required|integer',
                        'childrenCount' => 'required|integer',
                        'adultCount' => 'required|integer',
//                        'tripType' => 'required'
                    ]);


        DB::beginTransaction();
        //find the schedule to get the actual amount stored in the database
        $tripSchedule = \App\Models\Schedule::where('id', $attr['schedule_id'])
                                ->select('fare_adult', 'fare_children', 'id', 'seats_available', 'bus_id','departure_date','return_date','return_uuid_tracker','pickup_id','destination_id')->with('destination','pickup')->first();

        !$tripSchedule ? abort('404') : '';
        $adultFare = (double)$tripSchedule->fare_adult;
        $childrenFare = (double)$tripSchedule->fare_children;
        $tripType = request()->session()->get('tripType');

        if ((int)$tripType == 2) {
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


        $transactions = new \App\Models\Transaction();
        $transactions->reference        = Reference::generateTrnxRef();
        $transactions->amount           = $attr['amount'];
        $transactions->status           = 'Pending';
        $transactions->tenant_id        = $tripSchedule->bus->tenant->id;
        $transactions->schedule_id      = $attr['schedule_id'];
        $transactions->description      = 'Cash payment of ' . $request->amount .' was paid at ' . now();
        $transactions->user_id          = auth()->user()->id;
        $transactions->passenger_count  = $attr['adultCount'] + $attr['childrenCount'];
        $transactions->service_id       = $attr['service_id'];
        $transactions->transaction_type = 'cash payment';
        $transactions->isConfirmed       = 'False';
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

            //update available seats for this schedule and trip
            $updatedSeatCount = (int)($tripSchedule->seats_available) - ($attr['adultCount'] + $attr['childrenCount']);

            $tripSchedule->update([
                'seats_available' => $updatedSeatCount
            ]);

        }

        DB::commit();

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Bus Booking',
            'reference' => $transactions->reference,
            'transaction' => $transactions,
            'seatTrackers' => $seatTracker,
            'adultFare' => $adultFare,
            'childFare'=>$childrenFare,
            'tripType' => $tripType,
            'adultCount' => $attr['adultCount'],
            'childrenCount' => $attr['childrenCount'],
            'tripSchedule' => $tripSchedule,
            'totalAmount' => $attr['amount'],
            'destination' =>  $tripSchedule->destination->location,
            'pickup'=>  $tripSchedule->pickup->location

        ];

        $email = auth()->user()->email;

        Invoice::record(auth()->user()->id , $transactions->id , $tripType ,$tripSchedule->return_date);

        Mail::to($email)->send(new BusBooking($maildata));

        toastr()->success('Success !! cash payment made successfully');
        return  redirect('/');
    }
}
