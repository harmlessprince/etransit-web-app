<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */
namespace App\Billing;

use App\Classes\Reference;
use App\Mail\TourPackages;
use App\Models\Tour as TourPackage;
use App\Notifications\AdminOtherBookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Notification;
use PDF;

class TourPayment
{
    public  static function handleTourPayment($data)
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
        $transactions->tour_id = $data['data']['meta']['tour_id'];
        $transactions->isConfirmed = 'True';
        $transactions->save();

        $data["email"] = $data['data']['meta']['user_email'];
        $data['name']  =  $data['data']['meta']['user_name'];


        $trip = TourPackage::where('id',  $data['data']['meta']['tour_id'])->firstorfail();

        $maildata = [
            'name' =>  $data['name'] ,
            'service' => 'Tour Package',
            'transaction' => $transactions,
            'reference'=> $reference,
            'tour_name' => $trip->name,
            'location' => $trip->location,
            'tour_date' => $trip->tour_date->format('M-d-Y'),
            'tour_time' => $trip->tour_time->format('h:i:s'),
            'totalAmount' => $data['data']['amount'],
        ];



        Mail::to($data["email"])->send(new TourPackages($maildata));
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }

}
