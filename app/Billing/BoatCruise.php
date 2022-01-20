<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Billing;


use App\Classes\Reference;
use App\Mail\BoatCruiseBooking;
use App\Mail\BusBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class BoatCruise
{
    public static function handleCruisePayment($data)
    {
        DB::beginTransaction();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double) $data['data']['amount'];

        $transactions->status = 'Successful';
        $transactions->description =  $data['data']['meta']['description'];
        $transactions->user_id =  $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->boat_trip_id = $data['data']['meta']['boat_cruise_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] =   $data['data']['meta']['user_email'];
        $data['name']  =   $data['data']['meta']['user_name'];
        
        $maildata = [
            'name' =>  $data['name'],
            'service' => 'Boat Cruise',
            'transaction' => $transactions
        ];

        $email =   $data["email"];

        Mail::to($email)->send(new BoatCruiseBooking($maildata));

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }
}
