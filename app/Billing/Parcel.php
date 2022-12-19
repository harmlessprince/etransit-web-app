<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */
namespace App\Billing;

use App\Classes\Reference;
use App\Models\DeliveryParcel;
use App\Notifications\AdminOtherBookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Notification;
use PDF;

class Parcel
{
    public  static function handleParcelPayment($data)
    {
        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new Transaction();
        $transactions->reference = $reference;
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


        $findParcel = DeliveryParcel::where('id', $data['data']['meta']['delivery_parcel_id'])->with('city','delivery_city')->firstorfail();

        $maildata = [
            'name' =>   $data['data']['meta']['user_name'],
            'service' => 'Parcel delivery Service',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' => $data['data']['amount'],
            'delivery_city' => $findParcel->delivery_city->name,
            'pickup_city' => $findParcel->city->name
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new \App\Mail\Parcel($maildata));
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }

}
