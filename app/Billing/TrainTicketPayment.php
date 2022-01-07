<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Billing;


use App\Classes\Reference;
use App\Models\TrainSchedule;
use App\Models\TrainSeatTracker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class TrainTicketPayment
{


    public static  function handlePayment($data)
    {

            $childrenCount = (int)$data['data']['meta']['childrenCount'];
            $adultCount    = (int)$data['data']['meta']['adultCount'];
            $scheduleId    = (int)$data['data']['meta']['train_schedule_id'];
            $serviceId     = (int)$data['data']['meta']['service_id'];


            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = $data['data']['amount'];
            $transactions->status = 'Successful';
            $transactions->train_schedule_id = $scheduleId;
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->passenger_count = $adultCount + $childrenCount;
            $transactions->service_id = $serviceId;
            $transactions->isConfirmed = 'True';
            $transactions->save();

            if ($transactions) {
                $seat = TrainSchedule::where('id', $scheduleId)->first();

                $availableSeats =  (int) $seat->seats_available - (int)  $adultCount + $childrenCount;

                $seat->update([
                    'seats_available' => $availableSeats
                ]);

                $seatTracker = TrainSeatTracker::where('user_id',$data['data']['meta']['user_id']);
                //fetch seat selected and book
                $checkSeatsTracking = TrainSeatTracker::where('train_schedule_id',$scheduleId)
                                                        ->where('user_id', $data['data']['meta']['user_id'])
                                                        ->where('booked_status' , 1)->get();

                foreach($checkSeatsTracking as $seatTracker)
                {
                    $seatTracker->update([
                        'booked_status' => 2
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Payment made successfully']);
        }

}
