<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class Payment extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],
            "customizations" => [
                "title" => request()->service,
//                "description" => "Purchase of " . request()->service .' '. now()
            ],
            "meta"=>[
                "schedule_id"     => request()->schedule_id,
                "description"     =>  "Payment for " . request()->service .' at '. now() ,
                "user_id"         =>  auth()->user()->id,
                "childrenCount"   => request()->childrenCount,
                "adultCount"      => request()->adultCount,

            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

                  $transactionID = Flutterwave::getTransactionIDFromCallback();
                  $data = Flutterwave::verifyTransaction($transactionID);

                  //check if the maount paid is correct
                  $childrenCount  = (int)   $data['data']['meta']['childrenCount'];
                  $adultCount     = (int)   $data['data']['meta']['adultCount'];
                  $scheduleId     = (int)   $data['data']['meta']['schedule_id'];

                  //find the schedule to get the actual amount stored in the database
                  $tripSchedule   =   \App\Models\Schedule::where('id',$scheduleId)->select('fare_adult','fare_children','id','seats_available','bus_id')->first();
                  !$tripSchedule ? abort('404') : '';
                  $adultFare      =   (double) $tripSchedule->fare_adult;
                  $childrenFare   =   (double) $tripSchedule->fare_children;
                  $tripType = request()->session()->get('tripType');

                  if((int) $tripType == 2)
                  {
                      $type = 2;
                  }else{
                      $type = 1;
                  }
                  $ExpectedPay    =  ($adultFare * $adultCount + $childrenFare * $childrenCount)* $type ;

          if( $ExpectedPay  !=  $data['data']['amount'])
          {
              DB::beginTransaction();
              $transactions =  new \App\Models\Transaction();
              $transactions->reference        = Reference::generateTrnxRef();
              $transactions->trx_ref           = $data['data']['tx_ref'];
              $transactions->amount           =  $data['data']['amount'];
              $transactions->status           = 'fraud-detected';
              $transactions->schedule_id      =  $scheduleId ;
              $transactions->description      = $data['data']['meta']['description'];
              $transactions->user_id          = $data['data']['meta']['user_id'];
              $transactions->passenger_count  = $adultCount + $childrenCount;
              $transactions->save();
              toastr()->success('Payment made successfully');
              return redirect()->intended('/');;
              DB::commit();
          }else{
              DB::beginTransaction();
              $transactions =  new \App\Models\Transaction();
              $transactions->reference        =  Reference::generateTrnxRef();
              $transactions->trx_ref           =  $data['data']['tx_ref'];
              $transactions->amount           =  $data['data']['amount'];
              $transactions->status           = 'Successful';
              $transactions->schedule_id      =  $scheduleId ;
              $transactions->description      =  $data['data']['meta']['description'];
              $transactions->user_id          =  $data['data']['meta']['user_id'];
              $transactions->passenger_count  =  $adultCount + $childrenCount;
              $transactions->save();

              if($transactions)
              {
                  //update the status of seat tracker to booked after payment from selected
                  //0 = available 1 = selected 2 = booked
                  $seatTracker = \App\Models\SeatTracker::where('user_id', $data['data']['meta']['user_id'])
                      ->where('schedule_id',$scheduleId)->where('bus_id', $tripSchedule->bus_id)->get();

                  for($i = 0 ; $i < count($seatTracker) ; $i++)
                  {
                           $seatTracker[$i]->update([
                               'booked_status' => 2
                             ]);
                  }

                  //update available seats for this schedule and trip
                  $updatedSeatCount =  (int) ($tripSchedule->seats_available) - ($adultCount + $childrenCount);
                  $tripSchedule->update([
                      'seats_available' => $updatedSeatCount
                  ]);


              }
              $this->flushSession();
              DB::commit();
              toastr()->success('Payment made successfully');
              return redirect()->intended('/');;
          }

        }
        elseif ($status ==  'cancelled'){

        }
        else{
            //Put desired action/code after transaction has failed here
        }

    }

    public function flushSession()
    {
        request()->session()->forget('return_date');
        request()->session()->forget('tripType');
    }
}
