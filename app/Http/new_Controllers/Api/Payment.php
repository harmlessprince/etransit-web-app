<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Classes\Reference;
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Session;
//use KingFlamez\Rave\Facades\Rave as Flutterwave;
//
//class Payment extends Controller
//{
//    /**
//     * Initialize Rave payment process
//     * @return void
//     */
//    public function initialize(Request $request)
//    {
//
//       $data = request()->validate([
//            'seat_id' => 'sometimes|array',
//            'amount'  => 'required',
//            'schedule_id' => 'required'
//        ]);
//
//        $user = auth()->user();
//        $schedule = \App\Models\Schedule::where('id',$data['schedule_id'])->with('service')->first();
//        $request->seat_id  ? $seatCount = count($data['seat_id']): $seatCount = 1;
//
////        if(count($data['seat_id']) > 1)
////        {
//            Session::put('allocated_seats',$data['seat_id']);
////        }
//
//
//        $totalAmount = (double) $data['amount'] * (int) $seatCount;
//
//        //This generates a payment reference
//        $reference = Flutterwave::generateReference();
//        // Enter the details of the payment
//        $data = [
//            'payment_options' => 'card,banktransfer',
//            'amount' => $totalAmount,
//            'email' => request()->email,
//            'tx_ref' => $reference,
//            'currency' => "NGN",
//            'redirect_url' => route('callback'),
//            'customer' => [
//                'email' => $user->email,
//                "phone_number" => $user->phone_number,
//                "name" => $user->full_name
//            ],
//            "customizations" => [
//                "title" => $schedule->service->name
//            ],
//            "meta"=>[
//                "schedule_id"     => $schedule->id,
//                "description"     =>  "Payment for " . $schedule->service->name . " on ". now(),
//                "user_id"         =>  auth()->user()->id
//
//            ]
//        ];
//
//       $payment = Flutterwave::initializePayment($data);
//
//        if ($payment['status'] !== 'success') {
//            // notify something went wrong
//            return ;
//        }
//
////        return $payment;
//        return $payment['data']['link'];
//    }
//
//
//    /**
//     * Obtain Rave callback information
//     * @return void
//     */
//    public function callback()
//    {
//
//        $status = request()->status;
//
//        //if payment is successful
//        if ($status ==  'successful') {
//            $transactionID = Flutterwave::getTransactionIDFromCallback();
//            $data = Flutterwave::verifyTransaction($transactionID);
//
//
//            if (Session::has('allocated_seats')){
//                $seats  = Session::get('allocated_seats');
//                dd($seats);
//            }
//
////            dd($data['data']['meta']['allocated_seats']);
//            DB::beginTransaction();
//
//            $tranx               =  new  \App\Models\Transaction();
//            $tranx->reference    = Reference::generateTrnxRef();
//            $tranx->trx_ref      = $data['data']['tx_ref'];
//            $tranx->amount       = $data['data']['amount'];
//            $tranx->status       = $data['data']['status'];
//            $tranx->user_id      = $data['data']['meta']['user_id'];
//            $tranx->schedule_id  = $data['data']["meta"]['schedule_id'];
//            $tranx->description  = $data['data']['meta']['description'];
//            $tranx->save();
//
//            DB::commit();
//        }
//        elseif ($status ==  'cancelled'){
//            //Put desired action/code after transaction has been cancelled here
//        }
//        else{
//            //Put desired action/code after transaction has failed here
//        }
//        // Get the transaction from your DB using the transaction reference (txref)
//        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
//        // Confirm that the currency on your db transaction is equal to the returned currency
//        // Confirm that the db transaction amount is equal to the returned amount
//        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
//        // Give value for the transaction
//        // Update the transaction to note that you have given value for the transaction
//        // You can also redirect to your success page from here
//
//    }
//
//
//}
