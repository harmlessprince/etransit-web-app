<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */
namespace App\Billing;

use App\Classes\Reference;
use App\Mail\TourPackages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use PDF;

class TourPayment
{
    public  static function handleTourPayment($data)
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
        $transactions->tour_id = $data['data']['meta']['tour_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] = $data['data']['meta']['user_email'];
        $data['name']  =  $data['data']['meta']['user_name'];

        $maildata = [
            'name' =>  $data['data']['meta']['user_name'],
            'service' => 'Tour Package',
            'transaction' => $transactions
        ];


        Mail::to($data["email"])->send(new TourPackages($maildata));

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }

}
