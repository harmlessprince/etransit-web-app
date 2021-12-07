<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Billing;


use App\Classes\Reference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class BusTicketPayment
{


    public static  function handleBusPayment($data, $tripType)
    {

//        return response()->json($data['data']['meta']);
//check if the maount paid is correct
        $childrenCount = (int)$data['data']['meta']['childrenCount'];
        $adultCount = (int)$data['data']['meta']['adultCount'];
        $scheduleId = (int)$data['data']['meta']['schedule_id'];
        $serviceId = (int)$data['data']['meta']['service_id'];

//find the schedule to get the actual amount stored in the database
        $tripSchedule = \App\Models\Schedule::where('id', $scheduleId)->select('fare_adult', 'fare_children', 'id', 'seats_available', 'bus_id')->first();
        $adultFare = (double)$tripSchedule->fare_adult;
        $childrenFare = (double)$tripSchedule->fare_children;


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
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->passenger_count = $adultCount + $childrenCount;
            $transactions->service_id = $serviceId;
            $transactions->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Payment made successfully']);

        } else {
            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = $data['data']['amount'];
            $transactions->status = 'Successful';
            $transactions->schedule_id = $scheduleId;
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->passenger_count = $adultCount + $childrenCount;
            $transactions->service_id = $serviceId;
            $transactions->isConfirmed = 'True';
            $transactions->save();

            if ($transactions) {
//update the status of seat tracker to booked after payment from selected
//0 = available 1 = selected 2 = booked
                $seatTracker = \App\Models\SeatTracker::where('user_id', $data['data']['meta']['user_id'])
                    ->where('schedule_id', $scheduleId)->where('bus_id', $tripSchedule->bus_id)->get();

                for ($i = 0; $i < count($seatTracker); $i++) {
                    $seatTracker[$i]->update([
                        'booked_status' => 2
                    ]);
                }

//update available seats for this schedule and trip
                $updatedSeatCount = (int)($tripSchedule->seats_available) - ($adultCount + $childrenCount);
                $tripSchedule->update([
                    'seats_available' => $updatedSeatCount
                ]);


            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Payment made successfully']);
        }
    }
}
