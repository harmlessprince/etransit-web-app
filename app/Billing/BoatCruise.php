<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Billing;


use App\Classes\Reference;
use App\Mail\BoatCruiseBooking;
use App\Mail\AdminBooking;
use App\Models\BoatTrip;
use App\Notifications\AdminOtherBookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use PDF;

class BoatCruise
{
    public static function handleCruisePayment($data)
    {
        DB::beginTransaction();
        $reference =  Reference::generateTrnxRef();

        $transactions = new \App\Models\Transaction();
        $transactions->reference =$reference;
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


        $trip =  BoatTrip::where('id', $data['data']['meta']['boat_cruise_id'])->with('boat','cruiselocation')->firstorfail();

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
        $email =   $data["email"];

        Mail::to($email)->send(new BoatCruiseBooking($maildata));
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Payment made successfully']);

    }
}
