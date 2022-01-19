<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
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

        //find if the seats selected matches the number of passengers listed
        $selectedSeat = SeatTracker::where('schedule_id',$schedule_id)
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


    public function handleBusCashPayment(Request $request)
    {
            $attr  = request()->validate([
                        'amount' => 'required',
                        'service' => 'required',
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
        $tripType = request()->session()->get('tripType');

        if ((int)$tripType == 2) {
            $type = 2;
        } else {
            $type = 1;
        }

        DB::beginTransaction();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->amount = $attr['amount'];
        $transactions->status = 'Successful';
        $transactions->schedule_id = $attr['schedule_id'];
        $transactions->description = 'Cash payment of ' . $request->amount .' was paid at ' . now();
        $transactions->user_id = auth()->user()->id;
        $transactions->passenger_count = $attr['adultCount'] + $attr['childrenCount'];
        $transactions->service_id = $attr['service_id'];
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
        $data['name']  =  auth()->user()->full_name;
        $data["title"] = env('APP_NAME').' Bus Booking Receipt';
        $data["body"]  = "This is Demo";

        $pdf = PDF::loadView('pdf.car-hire', $data);

        Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "receipt.pdf");
        });

        toastr()->success('Success !! cash payment made successfully');
        return  redirect('/');
    }
}
