<?php

namespace App\Http\Controllers\Api;

use App\Billing\BusTicketPayment;
use App\Billing\CarHire;
use App\Billing\FerryPayment;
use App\Billing\TourPayment;
use App\Billing\BoatCruise;
use App\Billing\Parcel;
use App\Billing\TrainTicketPayment;
use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\CarHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use KingFlamez\Rave\Facades\Rave as Flutterwave;


class FlutterwavePayment extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        //get the type of service
      $service = \App\Models\Service::where('id' , request()->service_id)->first();


        if(! $service)
        {
            abort('404');
        }

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => auth()->user()->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('api.callback'),
            'customer' => [
                'email' => auth()->user()->email,
                "phone_number" => auth()->user()->phone,
                "name" => auth()->user()->full_name
            ],
            "customizations" => [
                "title" => $service->name,
            ],
            "meta" => [
                "schedule_id" => request()->schedule_id ?? null,
                "description" => "Payment for " . $service->name . ' at ' . now(),
                "user_id" => auth()->user()->id,
                "childrenCount" => request()->childrenCount ?? null,
                "adultCount" => request()->adultCount ?? null,
                'service_id' => $service->id,
                'user_email' => auth()->user()->email,
                'user_name' => auth()->user()->full_name,
                'plan_id' => request()->plan_id ?? null,
                'car_history_id' => request()->carhistory_id ?? null,
                'tour_id'   => request()->tour_id ?? null,
                'boat_cruise_id' => request()->boat_cruise_id ?? null,
                'delivery_parcel_id' => request()->delivery_parcel_id ?? null,
                'ferry_trip_id' => request()->ferry_trip_id ?? null,
                'train_schedule_id' => request()->train_schedule_id ?? null,

            ]
        ];

       $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return $payment['data']['link'];
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        //post back transaction ID generated by fluutterwave
        //two parameters essentianl for bus ticketting
        //transaction ID and tripType
        $transactionID = request()->id;
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $data = Flutterwave::verifyTransaction($transactionID);

            $serviceId = $data['data']['meta']['service_id'];
            $tripType = request()->get('tripType') ?? null;
            $fetchScheduleDetailsID = request()->fetchscheduledetailsId ?? null;

            switch($serviceId){
                case 1 :
                    BusTicketPayment::handleBusPayment($data , $tripType);
                    break;
                case 2 :
                    TrainTicketPayment::handlePayment($data);
                    break;
                case 3 :
                    //for ferry passs $data , $tripType , $fetchScheduleDetailsID;
                    FerryPayment::handlePayment($data , $tripType , $fetchScheduleDetailsID);
                    break;
                case 6:
                    CarHire::handleCarHirePayment($data);
                    break;
                case 7:
                    BoatCruise::handleCruisePayment($data);
                    break;
                case 8:
                    TourPayment::handleTourPayment($data);
                    break;
                case 9:
                    Parcel::handleParcelPayment($data);
                    break;
                default:
                    break;
            }

            return response()->json(['success' => true , 'message' => 'Payment made successfully' ]);


        }
        elseif ($status ==  'cancelled'){
            return response()->json(
                ['success'  => false ,
                    'message'  => 'Oops!! seems like something went wrong !']);
        }
        else{
            return response()->json(
                ['success'  => false ,
                    'message'  => 'Oops!! seems like something went wrong !']);
        }

    }
}
