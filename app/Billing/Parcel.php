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
use App\Models\Transaction;
use PDF;

class Parcel
{
    public  static function handleParcelPayment($data)
    {
        DB::beginTransaction();
        $transactions = new Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->trx_ref = $data['data']['tx_ref'];
        $transactions->amount = (double) $data['data']['amount'];

        $transactions->status = 'Successful';
        $transactions->description =  $data['data']['meta']['description'];
        $transactions->user_id =  $data['data']['meta']['user_id'];
        $transactions->service_id = $data['data']['meta']['service_id'];
        $transactions->delivery_parcel_id = $data['data']['meta']['delivery_parcel_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] = $data['data']['meta']['user_email'];
        $data['name']  =  $data['data']['meta']['user_name'];

        $maildata = [
            'name' =>  $data['data']['meta']['user_name'],
            'service' => 'Parcel delivery service',
            'transaction' => $transactions
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new \App\Mail\Parcel($maildata));

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }

}
