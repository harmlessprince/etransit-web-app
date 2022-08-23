<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Billing;


use App\Classes\Reference;
use App\Mail\FerryBookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class FerryPayment
{
    public static function handlePayment($data ,$tripType , $fetchScheduleDetailsID)
    {
        DB::beginTransaction();
        $tripSchedule = \App\Models\FerryTrip::where('id', $fetchScheduleDetailsID)
            ->select('amount_adult', 'amount_children', 'id', 'number_of_passengers', 'ferry_id' ,'event_date',
                'event_time','ferry_pick_up_id','ferry_destination_id')
                            ->with('destination','pickup')
                            ->first();

        $childrenCount = (int)$data['data']['meta']['childrenCount'];
        $adultCount = (int)$data['data']['meta']['adultCount'];


        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference =  $reference;
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double) $data['data']['amount'];

        $transactions->status = 'Successful';
        $transactions->description =  $data['data']['meta']['description'];
        $transactions->user_id =  $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->ferry_trip_id = $data['data']['meta']['ferry_trip_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] =   $data['data']['meta']['user_email'];
        $data['name']  =   $data['data']['meta']['user_name'];

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Ferry Booking',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' =>  $data['data']['amount'],
            'childrenCount' =>  $data['data']['meta']['childrenCountFerry'],
            'adultCount' => $data['data']['meta']['adultCountFerry'],
            'childFare' =>  $tripSchedule->amount_children,
            'adultFare' =>  $tripSchedule->amount_adult,
            'event_date' => $tripSchedule->event_date->format('M-d-Y'),
            'event_time' => $tripSchedule->event_time,
            'pickup' => $tripSchedule->pickup->locations,
            'destination' => $tripSchedule->destination->locations
        ];
        $email = $data["email"];

        Mail::to($email)->send(new FerryBookings($maildata));

        if ($transactions) {
            //update the status of seat tracker to booked after payment from selected
            //0 = available 1 = selected 2 = booked
            $seatTracker = \App\Models\FerrySeatTracker::where('user_id', $data['data']['meta']['user_id'])
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

        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }
}
