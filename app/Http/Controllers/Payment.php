<?php

namespace App\Http\Controllers;

use App\Classes\Invoice;
use App\Classes\Reference;
use App\Mail\AdminBooking;
use App\Mail\BoatCruiseBooking;
use App\Mail\CarHire;
use App\Mail\TourPackages;
use App\Mail\TrainTicket;
use App\Models\BoatTrip;
use App\Models\CarHistory;
use App\Models\CarPlan;
use App\Models\FerrySeatTracker;
use App\Models\FerryTrip;
use App\Models\Schedule;
use App\Models\SeatTracker;
use App\Models\Service;
use App\Models\Tour as TourPackage;
use App\Models\TrainSchedule;
use App\Models\TrainSeatTracker;
use App\Notifications\AdminBookingNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use PDF;

class Payment extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],
            "customizations" => [
                "title" => request()->service,
//                "description" => "Purchase of " . request()->service .' '. now()
            ],
            "meta" => [
                "schedule_id" => request()->schedule_id ?? null,
                "description" => "Payment for " . request()->service . ' at ' . now(),
                "user_id" => auth()->user()->id,
                "childrenCount" => request()->childrenCount ?? null,
                "adultCount" => request()->adultCount ?? null,
                'service_id' => request()->service_id,
                'user_email' => auth()->user()->email,
                'user_name' => auth()->user()->full_name,
                'plan_id' => request()->plan_id ?? null,
                'car_history_id' => request()->car_history_id ?? null,
                'cruiseType' => request()->cruiseType ?? null,
                'boatTrip_id' => request()->boatTrip_id ?? null,
                'tour_id' => request()->tour_id ?? null,
                "ferry_trip_id" => request()->ferry_trip_id ?? null,
                "childrenCountFerry" => request()->childrenCountFerry ?? null,
                "adultCountFerry" => request()->adultCountFerry ?? null,
                "tripTypeFerry" => request()->tripTypeFerry ?? null,
                "fetchFerryScheduleDetailsID" => request()->fetchFerryScheduleDetailsID ?? null,
                "train_schedule_id" => request()->train_schedule_id ?? null,
                "totalPasseneger" => request()->totalPasseneger ?? null,
                "childrenFareTotal" => request()->childrenFareTotal ?? null,
                "adultFareTotal" => request()->adultFareTotal ?? null,
                "return_date" => request()->return_date ?? null,

            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status == 'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            $serviceId = $data['data']['meta']['service_id'];

            switch ($serviceId) {
                case 1 :
                    $this->busTickettingPayment($data);
                    break;
                case 2:
                    $this->handleTrainPayment($data);
                    break;
                case 3:
                    $this->ferryPayment($data);
                    break;
                case 6:
                    $this->carHirePayment($data);
                    break;
                case 7:
                    $this->boatCruisePayment($data);
                    break;
                case 8:
                    $this->tourPackagePayment($data);
                    break;
                default:
                    break;
            }

            toastr()->success('Payment made successfully');
            return redirect()->intended('/');


        } elseif ($status == 'cancelled') {

        } else {
            //Put desired action/code after transaction has failed here
        }

    }


    protected function busTickettingPayment($data)
    {
        //check if the maount paid is correct
        $childrenCount = (int)$data['data']['meta']['childrenCount'];
        $adultCount = (int)$data['data']['meta']['adultCount'];
        $scheduleId = (int)$data['data']['meta']['schedule_id'];
        $serviceID = (int)$data['data']['meta']['service_id'];


        //find the schedule to get the actual amount stored in the database
        $tripSchedule = Schedule::where('id', $scheduleId)->select('fare_adult', 'fare_children', 'id', 'seats_available', 'departure_date',
            'return_date', 'bus_id', 'return_uuid_tracker', 'pickup_id', 'destination_id')->with('destination', 'pickup')->first();
        !$tripSchedule ? abort('404') : '';
        $adultFare = (double)$tripSchedule->fare_adult;
        $childrenFare = (double)$tripSchedule->fare_children;
        $tripType = request()->session()->get('tripType');

        if ((int)$tripType == 2) {
            $type = 2;
        } else {
            $type = 1;
        }
        $ExpectedPay = ($adultFare * $adultCount + $childrenFare * $childrenCount) * $type;

        if ($ExpectedPay != $data['data']['amount']) {
            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = $data['data']['amount'];
            $transactions->status = 'Likely Fraud';
            $transactions->schedule_id = $scheduleId;
            $transactions->tenant_id = $tripSchedule->bus->tenant->id;
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->passenger_count = $adultCount + $childrenCount;
            $transactions->service_id = $serviceID;
            $transactions->save();
            toastr()->success('Payment made successfully');
            return redirect()->intended('/');
            DB::commit();
        } else {
//            DB::beginTransaction();
//            $transactions = new \App\Models\Transaction();
//            $transactions->reference = Reference::generateTrnxRef();
//            $transactions->trx_ref = $data['data']['tx_ref'];
//            $transactions->amount = $data['data']['amount'];
//            $transactions->status = 'Successful';
//            $transactions->schedule_id = $scheduleId;
//            $transactions->tenant_id = $tripSchedule->bus->tenant->id;
//            $transactions->description = $data['data']['meta']['description'];
//            $transactions->user_id = $data['data']['meta']['user_id'];
//            $transactions->passenger_count = $adultCount + $childrenCount;
//            $transactions->service_id = $serviceID;
//            $transactions->isConfirmed = 'True';
//            $transactions->save();
//
//            if ($transactions) {
//                //update the status of seat tracker to booked after payment from selected
//                //0 = available 1 = selected 2 = booked
//                $seatTracker = \App\Models\SeatTracker::where('user_id', $data['data']['meta']['user_id'])
//                    ->where('schedule_id', $scheduleId)->where('bus_id', $tripSchedule->bus_id)->get();
//
//                for ($i = 0; $i < count($seatTracker); $i++) {
//                    $seatTracker[$i]->update([
//                        'booked_status' => 2
//                    ]);
//                }
//
//                //update available seats for this schedule and trip
//                $updatedSeatCount = (int)($tripSchedule->seats_available) - ($adultCount + $childrenCount);
//                $tripSchedule->update([
//                    'seats_available' => $updatedSeatCount
//                ]);
//
//                $maildata = [
//                    'name' =>  $data['data']['meta']['user_name'],
//                    'service' => 'Bus Booking',
//                    'transaction' => $transactions,
//                    'seatTrackers' => $seatTracker,
//                    'adultFare' => $adultFare,
//                    'childFare'=>$childrenFare,
//                    'tripType' => $tripType,
//                    'adultCount' => $adultCount,
//                    'childrenCount' => $childrenCount,
//                    'tripSchedule' => $tripSchedule,
//                    'totalAmount' => $data['data']['amount'],
//                ];
//                $email = $data['data']['meta']['user_email'];
//
//                Mail::to($email)->send(new BusBooking($maildata));
//            }
//            $this->flushSession();
//            DB::commit();

            DB::beginTransaction();

            if ($tripType == 2) {
                $type = 2;

                $scheduleReturnApp = Schedule::where('return_uuid_tracker', $tripSchedule->return_uuid_tracker)->where('isReturn', '=', 1)->first();
                if ($scheduleReturnApp) {
                    $selectedSeatForReturnTrip = SeatTracker::where('schedule_id', $scheduleReturnApp->id)
                        ->where('user_id', auth()->user()->id)
                        ->where('booked_status', 1)->get();
                }

            } else {
                $type = 1;
            }


            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = $data['data']['amount'];
            $transactions->status = 'Successful';
            $transactions->schedule_id = $scheduleId;
            $transactions->tenant_id = $tripSchedule->bus->tenant->id;
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->passenger_count = $adultCount + $childrenCount;
            $transactions->service_id = $serviceID;
            $transactions->isConfirmed = 'True';
            $transactions->save();

            if ($transactions) {
                //update the status of seat tracker to booked after payment from selected
                //0 = available 1 = selected 2 = booked
                $seatTracker = SeatTracker::where('user_id', auth()->user()->id)
                    ->where('schedule_id', $scheduleId)->where('bus_id', $tripSchedule->bus_id)->get();

                for ($i = 0, $iMax = count($seatTracker); $i < $iMax; $i++) {
                    $seatTracker[$i]->update([
                        'booked_status' => 2
                    ]);
                }

                if ($tripType == 2) {
                    for ($i = 0, $iMax = count($selectedSeatForReturnTrip); $i < $iMax; $i++) {
                        $selectedSeatForReturnTrip[$i]->update([
                            'booked_status' => 2
                        ]);
                    }

                    $updatedSeatCountForReturnTrip = (int)($scheduleReturnApp->seats_available) - ($adultCount + $childrenCount);

                    $scheduleReturnApp->update([
                        'seats_available' => $updatedSeatCountForReturnTrip
                    ]);
                }

                //update available seats for this schedule and trip
                $updatedSeatCount = (int)$tripSchedule->seats_available - ($adultCount + $childrenCount);

                $tripSchedule->seats_available = $updatedSeatCount;
                $tripSchedule->save();

            }

            DB::commit();
            $maildata = [
                'name' => $data['data']['meta']['user_name'],
                'service' => 'Bus Booking',
                'transaction' => $transactions,
                'reference' => $transactions->reference,
                'seatTrackers' => $seatTracker,
                'adultFare' => $adultFare,
                'childFare' => $childrenFare,
                'tripType' => $tripType,
                'adultCount' => $adultCount,
                'childrenCount' => $childrenCount,
                'tripSchedule' => $tripSchedule,
                'totalAmount' => $data['data']['amount'],
                'destination' => $tripSchedule->destination->location,
                'pickup' => $tripSchedule->pickup->location
            ];
            $email = $data['data']['meta']['user_email'];

            Invoice::record($data['data']['meta']['user_id'], $transactions->id, $tripType, $tripSchedule->return_date);

            Mail::to($email)->send(new AdminBooking($maildata));
            Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
                ->notify(new AdminBookingNotification($maildata));

        }
    }


    protected function carHirePayment($data)
    {

        $serviceID = (int)$data['data']['meta']['service_id'];
        $planId = (int)$data['data']['meta']['plan_id'];
        $carPlan = CarPlan::where('id', $planId)->firstorfail();
        $carHistory = CarHistory::where('id', $data['data']['meta']['car_history_id'])->first();


        if (!$carPlan) {
            abort('404');
        }

        $exactFare = (double)$carPlan->amount;

        if ($exactFare != (double)$data['data']['amount']) {
            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = (double)$data['data']['amount'];
            $transactions->status = 'Likely Fraud';
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->tenant_id = $carHistory->car->tenant_id;
            $transactions->service_id = $serviceID;
            $transactions->isConfirmed = 'True';
            $transactions->save();
            DB::commit();

        } else {

            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = (double)$data['data']['amount'];
            $transactions->status = 'Successful';
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->service_id = $serviceID;
            $transactions->tenant_id = $carHistory->car->tenant_id;
            $transactions->isConfirmed = 'True';
            $transactions->save();

            $carHistory = CarHistory::where('id', $data['data']['meta']['car_history_id'])->first();
            $carHistory->update(['payment_status' => 'paid', 'isConfirmed' => 'True']);


            $maildata = [
                'name' => $data['data']['meta']['user_name'],
                'reference' => $transactions->reference,
                'service' => 'Car Hire',
                'transaction' => $transactions,
                'plan' => $carPlan->plan,
                'plan_amount' => $carPlan->amount,
                'payment_method' => 'cash payment',
                'total_payment' => $data['data']['amount'],
                'pickup_date' => $carHistory->returnDate->format('Y-m-d'),
                'pickup_time' => $carHistory->returnTime->format('h:i:s'),
                'number_of_days' => $carHistory->days

            ];

            $email = $data['data']['meta']['user_email'];

            Mail::to($email)->send(new CarHire($maildata));

            DB::commit();
        }


    }

    public function boatCruisePayment($data)
    {
        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = $reference;
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double)$data['data']['amount'];
        $transactions->status = 'Successful';
        $transactions->description = $data['data']['meta']['description'];
        $transactions->user_id = $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->boat_trip_id = $data['data']['meta']['boatTrip_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] = $data['data']['meta']['user_email'];
        $data['name'] = $data['data']['meta']['user_name'];

        $trip = BoatTrip::where('id', $data['data']['meta']['boatTrip_id'])->with('boat', 'cruiselocation')->firstorfail();

        $maildata = [
            'name' => $data['data']['meta']['user_name'],
            'service' => 'Boat Cruise',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' => $data['data']['amount'],
            'cruise_name' => $trip->cruise_name,
            'cruise_destination' => $trip->cruiselocation->destination,
            'boat_name' => $trip->boat->name,
            'departure_date' => $trip->departure_date->format('M-d-Y'),
            'departure_time' => $trip->departure_time->format('h:i:s')
        ];

        $email = $data["email"];

        Mail::to($email)->send(new BoatCruiseBooking($maildata));

        DB::commit();
    }

    public function ferryPayment($data)
    {
        DB::beginTransaction();

        $tripSchedule = FerryTrip::where('id', $data['data']['meta']['fetchFerryScheduleDetailsID'])
            ->select('amount_adult', 'amount_children', 'id', 'number_of_passengers', 'ferry_id'
                , 'event_date', 'event_time', 'ferry_pick_up_id', 'ferry_destination_id')
            ->with('destination', 'pickup')
            ->first();

        $service = Service::where('id', $data['data']['meta']['service_id'])->first();

        $childrenCountFerry = (int)$data['data']['meta']['childrenCountFerry'];
        $adultCountFerry = (int)$data['data']['meta']['adultCountFerry'];
        $reference = Reference::generateTrnxRef();

        $transactions = new \App\Models\Transaction();

        $transactions->reference = $reference;
        $transactions->amount = (double)$data['data']['amount'];
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->status = 'Successful';
        $transactions->description = $data['data']['meta']['description'];
        $transactions->user_id = $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->ferry_trip_id = $data['data']['meta']['ferry_trip_id'];
        $transactions->save();

        $data["email"] = $data['data']['meta']['email'];
        $data['name'] = $data['data']['meta']['user_name'];

        $maildata = [
            'name' => $data['data']['meta']['user_name'],
            'service' => 'Ferry Booking',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' => $data['data']['amount'],
            'childrenCount' => $data['data']['meta']['childrenCountFerry'],
            'adultCount' => $data['data']['meta']['adultCountFerry'],
            'childFare' => $tripSchedule->amount_children,
            'adultFare' => $tripSchedule->amount_adult,
            'event_date' => $tripSchedule->event_date->format('M-d-Y'),
            'event_time' => $tripSchedule->event_time,
            'pickup' => $tripSchedule->pickup->locations,
            'destination' => $tripSchedule->destination->locations
        ];

        $email = $data["email"];

        Mail::to($email)->send(new \App\Mail\FerryBookings($maildata));

        if ($transactions) {
            //update the status of seat tracker to booked after payment from selected
            //0 = available 1 = selected 2 = booked
            $seatTracker = FerrySeatTracker::where('user_id', $data['data']['meta']['user_id'])
                ->where('ferry_trip_id', $tripSchedule->id)->where('ferry_id', $tripSchedule->ferry_id)->get();

            for ($i = 0; $i < count($seatTracker); $i++) {
                $seatTracker[$i]->update([
                    'booked_status' => 2
                ]);
            }

            //update available seats for this schedule and trip
            $updatedSeatCount = (int)($tripSchedule->number_of_passengers) - ($adultCountFerry + $childrenCountFerry);
            $tripSchedule->update([
                'number_of_passengers' => $updatedSeatCount
            ]);


        }

        DB::commit();

//        toastr()->success('Cash Payment made successfully');
//
//        return redirect('/');
    }

    public function tourPackagePayment($data)
    {
        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = $reference;
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double)$data['data']['amount'];
        $transactions->status = 'Successful';
        $transactions->description = $data['data']['meta']['description'];
        $transactions->user_id = $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->tour_id = $data['data']['meta']['tour_id'];
        $transactions->save();

        $data["email"] = $data['data']['meta']['user_email'];
        $data['name'] = $data['data']['meta']['user_name'];

        $trip = TourPackage::where('id', $data['data']['meta']['tour_id'])->firstorfail();

        $maildata = [
            'name' => $data['name'],
            'service' => 'Tour Package',
            'transaction' => $transactions,
            'reference' => $reference,
            'tour_name' => $trip->name,
            'location' => $trip->location,
            'tour_date' => $trip->tour_date->format('M-d-Y'),
            'tour_time' => $trip->tour_time->format('h:i:s'),
            'totalAmount' => $data['data']['amount'],
        ];

        Mail::to($data["email"])->send(new TourPackages($maildata));

        DB::commit();
    }


    public function handleTrainPayment($data)
    {
//        request()->validate([
//            'amount'            => 'required',
//            'service_id'        => 'required|integer',
//            'train_schedule_id' => 'required|integer',
//            'totalPasseneger'   => 'required|integer'
//        ]);

        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = $reference;
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double)$data['data']['amount'];
        $transactions->status = 'Successful';
        $transactions->description = $data['data']['meta']['description'];
        $transactions->user_id = $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->train_schedule_id = $data['data']['meta']['train_schedule_id'];
        $transactions->save();


        //find tain schedule and update the seat availability
        $seat = TrainSchedule::where('id', $data['data']['meta']['train_schedule_id'])->first();
        $availableSeats = (int)$seat->seats_available - (int)$data['data']['meta']['totalPasseneger'];
        $seat->update([
            'seats_available' => $availableSeats
        ]);

        //fetch seat selected and book
        $checkSeatsTracking = TrainSeatTracker::where('train_schedule_id', $data['data']['meta']['train_schedule_id'])
            ->where('user_id', $data['data']['meta']['user_id'])
            ->where('booked_status', 1)->get();

        foreach ($checkSeatsTracking as $seatTracker) {
            $seatTracker->update([
                'booked_status' => 2
            ]);
        }


        $data["email"] = $data['data']['meta']['user_email'];
        $data['name'] = $data['data']['meta']['user_name'];

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Train Booking',
            'transaction' => $transactions,
            'reference' => $reference,
            'departure_date' => $seat->departure_date->format('Y-m-d'),
            'departure_time' => $seat->departure_time,
            'totalAmount' => $data['data']['amount'],
            'childrenCount' => $data['data']['meta']['childrenCount'],
            'adultCount' => $data['data']['meta']['adultCount'],
            'childFare' => $data['data']['meta']['childrenFareTotal'],
            'adultFare' => $data['data']['meta']['adultFareTotal'],
            'return_date' => $data['data']['meta']['return_date'],
        ];
        $email = $data["email"];

        Mail::to($email)->send(new TrainTicket($maildata));

        DB::commit();

//        toastr()->success('Success !! Cash Payment made successfully');
//        return redirect('/');

    }


    public function flushSession()
    {
        request()->session()->forget('return_date');
        request()->session()->forget('tripType');
    }
}
