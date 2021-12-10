<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */
namespace App\Billing;

use App\Classes\Reference;
use App\Models\CarHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use PDF;

class CarHire
{
    public static function handleCarHirePayment($data , $car_history_id)
    {

        $serviceID     = (int)   $data['data']['meta']['service_id'];
        $planId        = (int)   $data['data']['meta']['plan_id'];

        $carPlan = \App\Models\CarPlan::where('id' , $planId)->firstorfail();


        if(!$carPlan)
        {
            abort('404');
        }

        $exactFare = (double) $carPlan->amount;

        if($exactFare != (double) $data['data']['amount'])
        {
            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = (double) $data['data']['amount'];
            $transactions->status = 'Likely Fraud';
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->service_id = $serviceID;
            $transactions->car_history_id = $car_history_id;
            $transactions->isConfirmed = 'True';
            $transactions->save();
            DB::commit();
            return response()->json(['success' => true ,'message' => 'Payment made successfully']);

        }else{

            DB::beginTransaction();
            $transactions = new \App\Models\Transaction();
            $transactions->reference = Reference::generateTrnxRef();
            $transactions->trx_ref = $data['data']['tx_ref'];
            $transactions->amount = (double) $data['data']['amount'];
            $transactions->status = 'Successful';
            $transactions->description = $data['data']['meta']['description'];
            $transactions->user_id = $data['data']['meta']['user_id'];
            $transactions->service_id = $serviceID;
            $transactions->car_history_id = $car_history_id;
            $transactions->isConfirmed = 'True';
            $transactions->save();

            $carHistory = CarHistory::where('id', $data['data']['meta']['car_history_id'])->first();
            $carHistory->update(['payment_status' => 'paid' ,'isConfirmed' => 'True']);


            $data["email"] =  $data['data']['meta']['user_email'];
            $data['name']  =  $data['data']['meta']['user_name'];
            $data["title"] = env('APP_NAME').' Car Hire Receipt';
            $data["body"]  = "This is Demo";

            $pdf = PDF::loadView('pdf.car-hire', $data);

            Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
                $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "receipt.pdf");
            });

            DB::commit();
            return response()->json(['success' => true ,'message' => 'Payment made successfully']);
        }


    }
}
