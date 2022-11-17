<?php

namespace App\Http\Controllers\Eticket;

use DataTables;
use App\Classes\Invoice;
use App\Mail\AdminBooking;
use App\Models\Schedule;
use App\Models\Passenger;
use App\Classes\Reference;
use App\Models\SeatTracker;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\OnsiteCustomer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OnsiteInvoice;
use App\Models\Tenant;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use PDF;

class EticketManifest extends Controller
{
    public function manifest($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
        $bookings =  Passenger::where('schedule_id',$schedule_id)->count();
        $tranx =  Transaction::where('schedule_id', $schedule_id)->pluck('amount')->sum();




        return  view('Eticket.bus.manifest', compact('schedule','bookings','tranx'));
    }

    public function fetchBusManifest(Request $request , $schedule_id)
    {

        if ($request->ajax()) {
            $data = Passenger::where('schedule_id',$schedule_id)->with(['user','seat_position','onsite_customer'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nextOfKin', function($passenger){
                    $name = $passenger->next_of_kin_name;
                    $passenger->next_of_kin_number;
                    $nextofkin = "$name,   $passenger->next_of_kin_number";
                    return $nextofkin;
                })
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='#' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->addColumn('contact', function($passenger){
                    $contact = $passenger->user ? $passenger->user->email : $passenger->onsite_customer->phone;
                    return $contact;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addPassenger($schedule_id, $tripType = 1 ){
        $fetchSeats = \App\Models\SeatTracker::where('schedule_id' ,$schedule_id)
                                        ->select('seat_position','id','booked_status')->get();

        return view('Eticket.bus.add-passenger' , compact('fetchSeats' ,'schedule_id','tripType'));
    }

    public function addPassengers(Request $request, $schedule_id, $trip_type = 1 ){

        request()->validate([
            'full_name' => 'required|array',
            'gender' => 'required|array',
            'passenger_option' => 'required|array',
            'next_of_kin_name' => 'required|array',
            'next_of_kin_number' => 'required|array',
            'phone'=> 'required|array'
        ]);
        //'email' => 'nullable|email|array',
        $passengerArray = [];
        $passengers = $request->full_name;
        $phones = $request->phone;


        foreach ($passengers as $passenger) {
            if ($passenger != null) {
                array_push($passengerArray, $passenger);
            }
        }
        $customer = OnsiteCustomer::where('phone',$phones[0])->first();
        if(is_null($customer)){
            $newCustomer = OnsiteCustomer::create([
                'name'=> $passengerArray[0],
                'phone'=> $phones[0],
                'email'=> $request->email[0] ?? null,
            ]);
            $customer = $newCustomer->id;
        }else{
            $newCustomer = $customer;
            $customer = $customer->id;
        }
        //find seats selected on user's device
        if(Cookie::has('seats')){
            $seatsondevice = json_decode(Cookie::get('seats'));
            if(count($seatsondevice) < 1){
                toastr()->error('No seats selected. Please select seat(s)');
                return back();
            }

        }else{
            toastr()->error('No seats selected. Please select seat(s)');
            return back();
        }

        //find if the seats selected matches the number of passengers listed
        $selectedSeat = SeatTracker::where('schedule_id', $schedule_id)
            //->where('onsite_customer_id', $customer)
            ->where('tenant_id', session()->get('tenant_id'))
            ->where('booked_status', 1)
            ->whereIn('id',$seatsondevice)->get();

        if ((int)$trip_type == 2) {
            $checkSchedule = Schedule::find($schedule_id);


            $scheduleReturnApp = Schedule::where('return_uuid_tracker', $checkSchedule->return_uuid_tracker)->where('isReturn', '=', 1)->first();


            if ($scheduleReturnApp) {
                $selectedSeatForReturnTrip  = \App\Models\SeatTracker::where('schedule_id', $scheduleReturnApp->id)
                //->where('onsite_customer_id', $customer)
                ->where('tenant_id',session()->get('tenant_id'))
                ->where('booked_status', 1)->get();

            }
        }


        $passenger_options = $request['passenger_option'];


        if (is_null($passenger_options)) {

            foreach ($selectedSeat as $unbookedseat) {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'onsite_customer_id' => null,
                    'tenant_id' => null
                ]);
            }

            if ((int)$trip_type == 2) {
                foreach ($selectedSeatForReturnTrip as $unbookedReturnTripSeat) {
                    $unbookedReturnTripSeat->update([
                        'booked_status' => 0,
                        'onsite_customer_id' => null,
                        'tenant_id'=> null
                    ]);
                }
            }

            toastr()->error('Please select passenger age range option');
            return back();
        }


        $passengerOptionCount = count($passenger_options);
        $passengerCount = count($passengerArray);

        $fetchScheduleDetails = Schedule::where('id', $schedule_id)->with('service', 'bus', 'destination', 'pickup', 'terminal')->first();

        if ($passengerCount != count($selectedSeat)) {

            foreach ($selectedSeat as $unbookedseat) {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'onsite_customer_id' => null,
                    'tenant_id'=> null
                ]);
            }

            if ((int)$trip_type == 2) {
                foreach ($selectedSeatForReturnTrip as $unbookedReturnTripSeat) {
                    $unbookedReturnTripSeat->update([
                        'booked_status' => 0,
                        'onsite_customer_id' => null,
                        'tenant_id'=> null
                    ]);
                }
            }

            toastr()->error('Number of seats selected must match the number of passengers');
            return  back();
        }

        if ($passengerCount != $passengerOptionCount) {

            foreach ($selectedSeat as $unbookedseat) {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'onsite_customer_id' => null,
                    'tenant_id'=> null
                ]);
            }

            if ((int)$trip_type == 2) {
                foreach ($selectedSeatForReturnTrip as $unbookedReturnTripSeat) {
                    $unbookedReturnTripSeat->update([
                        'booked_status' => 0,
                        'onsite_customer_id' => null,
                        'tenant_id'=> null
                    ]);
                }
            }
            toastr()->error('Please ensure the gender option is chosen for each passenger');
            return  back();
        } else {

            $adult = [];
            $children = [];

            foreach ($passenger_options as $passenger_option) {
                if (strtolower($passenger_option) == 'adult') {
                    array_push($adult, $passenger_option);
                } elseif (strtolower($passenger_option) == 'children') {
                    array_push($children, $passenger_option);
                }
            }
        }

        $adultCount = count($adult);
        $childrenCount = count($children);

        for ($i = 0; $i < $passengerOptionCount; $i++) {
            $createPassenger                        = new \App\Models\Passenger();
            $createPassenger->full_name             = $request->full_name[$i];
            $createPassenger->gender                = $request->gender[$i];
            $createPassenger->passenger_age_range   = $request->passenger_option[$i];
            $createPassenger->schedule_id           = $schedule_id;
            $createPassenger->next_of_kin_name      = $request->next_of_kin_name[$i];
            $createPassenger->next_of_kin_number    = $request->next_of_kin_number[$i];
            $createPassenger->onsite_customer_id    = $customer;
            $createPassenger->seat_tracker_id       = $selectedSeat[$i]->id;
            $createPassenger->save();
        }

        if ((int)$trip_type == 2) {
            for ($i = 0; $i < $passengerOptionCount; $i++) {
                $createPassenger                        = new \App\Models\Passenger();
                $createPassenger->full_name             = $request->full_name[$i];
                $createPassenger->gender                = $request->gender[$i];
                $createPassenger->passenger_age_range   = $request->passenger_option[$i];
                $createPassenger->schedule_id           = $scheduleReturnApp->id;
                $createPassenger->next_of_kin_name      = $request->next_of_kin_name[$i];
                $createPassenger->next_of_kin_number    = $request->next_of_kin_number[$i];
                $createPassenger->onsite_customer_id    = $customer;
                $createPassenger->seat_tracker_id       = $selectedSeatForReturnTrip[$i]->id;
                $createPassenger->save();
            }
        }

        $returnDate = request()->session()->get('return_date');
        $tripType = $trip_type;

        $totalFare = ((float)  $fetchScheduleDetails->fare_adult * (int) $adultCount +
            (float) $fetchScheduleDetails->fare_children * (int) $childrenCount) * (int) $tripType;
        if ((int) $tripType == 2) {
            $returnDate  = date('d:M:Y ', strtotime($returnDate));
        } else {
            $returnDate = null;
        }
        DB::beginTransaction();
        //find the schedule to get the actual amount stored in the database
        $tripSchedule = \App\Models\Schedule::where('id', $schedule_id)
                                ->select('seats_available')->first();

        !$fetchScheduleDetails ? abort('404') : '';
        $adultFare = (double)$fetchScheduleDetails->fare_adult;
        $childrenFare = (double)$fetchScheduleDetails->fare_children;
        //$tripType = request()->session()->get('tripType');

        if ((int)$tripType == 2) {
            $type = 2;

            $scheduleReturnApp = Schedule::where('return_uuid_tracker' , $fetchScheduleDetails->return_uuid_tracker)->where('isReturn','=',1)->first();

            if($scheduleReturnApp)
            {
                $selectedSeatForReturnTrip  = \App\Models\SeatTracker::where('schedule_id',$scheduleReturnApp->id)
                    ->where('user_id',session()->get('tenant_id'))
                    ->where('booked_status', 1)->get();
            }

        } else {
            $type = 1;
        }


        $transactions = new \App\Models\Transaction();
        $transactions->reference        = Reference::generateTrnxRef();
        $transactions->amount           = $totalFare;
        $transactions->status           = 'Successful';
        $transactions->tenant_id        = $fetchScheduleDetails->bus->tenant->id;
        $transactions->schedule_id      = $schedule_id;
        $transactions->description      = 'On-site payment of ' . $totalFare .' was paid at ' . now();
        $transactions->passenger_count  = $adultCount + $childrenCount;
        $transactions->service_id       = $fetchScheduleDetails->service->id;
        $transactions->onsite_customer_id = $customer;
        $transactions->transaction_type = 'onsite';
        $transactions->isConfirmed       = 'False';
        $transactions->save();

        if ($transactions) {
            //update the status of seat tracker to booked after payment from selected
            //0 = available 1 = selected 2 = booked
            $seatTracker = \App\Models\SeatTracker::where('user_id', session()->get('tenant_id'))
                ->where('schedule_id', $schedule_id)
                ->where('bus_id', $fetchScheduleDetails->bus_id)
                ->whereIn('id', $seatsondevice)
                ->get();

            for ($i = 0; $i < count($seatTracker); $i++) {
                $seatTracker[$i]->update([
                    'booked_status' => 2,
                    'onsite_customer_id'=> $customer
                ]);
            }

            if($tripType == 2)
            {
                for($i = 0 ; $i < count($selectedSeatForReturnTrip); $i++)
                {
                    $selectedSeatForReturnTrip[$i]->update([
                        'booked_status' => 2,
                        'onsite_customer_id'=> $customer
                    ]);
                }

                $updatedSeatCountForReturnTrip = (int) ($scheduleReturnApp->seats_available) -  ($adultCount + $childrenCount);

                $scheduleReturnApp->update([
                    'seats_available' => $updatedSeatCountForReturnTrip
                ]);
            }

            //update available seats for this schedule and trip
            $updatedSeatCount = (int)($tripSchedule->seats_available) - ($adultCount + $childrenCount);

            $tripSchedule->update([
                'seats_available' => $updatedSeatCount
            ]);

        }

        DB::commit();
        $invoice = OnsiteInvoice::create([
            'schedule_id' => $fetchScheduleDetails->id,
            'transaction_id' => $transactions->id,
            'onsite_customer_id' => $customer,
            'adultCount' => $adultCount,
            'childrenCount' => $childrenCount,
            'tripType' => $tripType
        ]);
        $data = [
            'name' => $passengers[0],
            'service' => 'Bus Booking',
            'transaction' => $transactions,
            'seatTrackers' => $seatTracker,
            'adultFare' => $adultFare,
            'childFare'=>$childrenFare,
            'tripType' => $tripType,
            'adultCount' => $adultCount,
            'childrenCount' => $childrenCount,
            'scheduleDetails' => $fetchScheduleDetails,
            'totalAmount' => $totalFare,
            'passengers' => $passengers,
            'customer' => $newCustomer,
            'tripType' => $tripType,
            'invoiceId' => $invoice->id
        ];

        toastr()->success('Success !! Booking completed successfully');

        return view('Eticket.bus.successful-booking', ['data' => $data]);
    }

    public function printTicket($invoiceId){

        $invoice = OnsiteInvoice::with('Schedule','transaction','OnsiteCustomer', 'Schedule.tenant', 'Schedule.pickup', 'Schedule.destination')->find($invoiceId);

        $data = [
            'tenant' => $invoice->Schedule->tenant->company_name,
            'name' => $invoice->OnsiteCustomer->name,
            'source' => $invoice->Schedule->pickup->location,
            'destination' => $invoice->Schedule->destination->location,
            'departure' => $invoice->Schedule->departure_date,
            'time' => $invoice->Schedule->departure_time,
            'return_date' => $invoice->Schedule->return_date,
            'adultCount' => $invoice->adultCount,
            'childrenCount' => $invoice->childrenCount,
            'adultFare' => $invoice->Schedule->fare_adult,
            'childFare' => $invoice->Schedule->fare_children,
            'tripType' => $invoice->tripType,
            'totalAmount' => $invoice->transaction->amount
        ];


        $customPaper = array(0,0,800.00,400.80);
        $pdf = PDF::loadView('pdf.eticket-bus-booking', ['data'=> $data])->setPaper($customPaper, 'landscape');
        $ticket = $pdf->output();
        //$response = Response::make($ticket, 200);
        //$response->header('Content-Type', 'application/pdf');
        return $pdf->stream('eticket'.$data['name'].'\.pdf');

    }

    public function fetchPassengerDetails($seat_tracker_id)
    {
        $passenger =  Passenger::where('seat_tracker_id',$seat_tracker_id)->first();
        return response()->json(['success' => true , 'data' => compact('passenger')]);

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
                'tenant_id' => $request->tenant_id
                //'onsite_customer_id' => $request->tenant_id
            ]);
            if(Cookie::has('seats')){
                $seats = json_decode(Cookie::get('seats'));
                array_push($seats, $data['seat_id']);
                $seatscookie = cookie('seats',json_encode($seats),30);
            }else{
                $seats = [];
                array_push($seats, $data['seat_id']);
                $seatscookie = cookie('seats',json_encode($seats),30);
            }

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
                                'tenant_id'=> $request->tenant_id
                                //'onsite_customer_id' => $request->onsite_customer_id
                            ]);
                       }
                   }



           }
           DB::commit();

           return response()->json(['success' => true , 'message' => 'Seat Selected successfully'])->withCookie($seatscookie);
       }

        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);

    }

    public function deselectSeat(Request $request)
    {
        $data = request()->validate([
            'seat_id' => 'required',
            'trip_type' => 'required'
        ]);

        $seat = \App\Models\SeatTracker::where('id' ,$data['seat_id'])->where('tenant_id',session()->get('tenant_id'))->first();

        if($seat->booked_status != 2)
        {
            $seat->update([
                'booked_status' => 0,
                'user_id' => null,
                'onsite_customer_id' => null
            ]);
            $seats = json_decode(Cookie::get('seats'));
            $seatskey =array_search($data['seat_id'], $seats);
            unset($seats[$seatskey]);
            $modifiedseats = array_values($seats);
            $modifiedseatscookie = cookie('seats',json_encode($modifiedseats),30);

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
            return response()->json(['success' => true , 'message' => 'Seat de-selected successfully'])->withCookie('seats');
        }
        return response()->json(['success' => false , 'message' => 'Seat has already been booked']);
    }
}
