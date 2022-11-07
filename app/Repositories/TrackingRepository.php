<?php

namespace App\Repositories;

use App\Classes\GenerateAuthorizationOtp;
use App\Classes\SmsGateWayTrigger;
use App\Interfaces\TrackingInterface;
use App\Mail\TrackingNotificationTrigger;
use App\Models\Tracker;
use App\Models\TrackingRecord;
use App\Models\Transaction;
use App\Models\UserTrustee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TrackingRepository implements TrackingInterface
{


    public function trackUser($userId , $trackingDetails , $transaction_id)
    {
        DB::beginTransaction();
        $tracker = new Tracker();
        $tracker->user_id = $userId;
        $tracker->tracking_type = $trackingDetails['tracking_type'];
        $tracker->purpose_of_movement =  $trackingDetails['purpose_of_movement'];
        $tracker->destination_description =  $trackingDetails['destination_description'];

        if($transaction_id != null)
        {
               $trackingTransaction =  Transaction::where('id',$transaction_id)
                                                    ->select('service_id','schedule_id','car_history_id','tour_id','tenant_id',
                                                        'boat_trip_id','delivery_parcel_id','ferry_trip_id','train_schedule_id')->first();

               if(!$trackingTransaction)
               {
                  return    $response = ['success' => false , 'message' =>  'Transaction could not be fetched'];
               }

                switch($trackingTransaction->service_id) {
                    case 1:
                        //bus service
                        $tracker->service_id      =  $trackingTransaction->service_id;
                        $tracker->schedule_id     =  $trackingTransaction->schedule_id;
                        $tracker->tenant_id       = $trackingTransaction->tenant_id;
                        $tracker->transaction_id  =  $transaction_id;
                        break;
                    case 2:
                        //train service
                        $tracker->service_id        =  $trackingTransaction->service_id;
                        $tracker->train_schedule_id =  $trackingTransaction->train_schedule_id;
                        $tracker->transaction_id    =  $transaction_id;
                        break;
                    case 3:
                        //ferry
                        $tracker->service_id      =  $trackingTransaction->service_id;
                        $tracker->ferry_trip_id   =  $trackingTransaction->ferry_trip_id;
                        $tracker->transaction_id  =  $transaction_id;
                        break;
                    case 6:
                        //car hire
                        $tracker->service_id      =  $trackingTransaction->service_id;
                        $tracker->car_history_id  =  $trackingTransaction->car_history_id;
                        $tracker->tenant_id       = $trackingTransaction->tenant_id;
                        $tracker->transaction_id  =  $transaction_id;
                        break;
                    case 7:
                        //boat cruise
                        $tracker->service_id      =  $trackingTransaction->service_id;
                        $tracker->boat_trip_id    =  $trackingTransaction->boat_trip_id;
                        $tracker->transaction_id  =  $transaction_id;
                        break;
                    case 8:
                        //tour
                        $tracker->service_id      =  $trackingTransaction->service_id;
                        $tracker->tour_id         =  $trackingTransaction->tour_id;
                        $tracker->transaction_id  =  $transaction_id;
                        break;
                    case 9:
                        //parcel
                        $tracker->service_id           =  $trackingTransaction->service_id;
                        $tracker->delivery_parcel_id   =  $trackingTransaction->delivery_parcel_id;
                        $tracker->transaction_id       =  $transaction_id;
                        break;
                    default:
                        return   $response = ['success' => false , 'message' =>  'An issue occurred with the transaction ID passed'];
                }
        }
        $tracker->save();
        if($tracker)
        {
            $trustee = new UserTrustee();
            $trustee->full_name    = $trackingDetails['next_of_kin_name'];
            $trustee->email        = $trackingDetails['next_of_kin_email'];
            $trustee->phone_number = $trackingDetails['next_of_kin_phone_number'];
            $trustee->tracker_id   = $tracker->id;
            $trustee->save();
        }
        DB::commit();

        return  $tracker;
    }


    public function initiateTracking($user_id , $locationDetails)
    {
        // TODO: Implement initiateTracking() method.
        // Look for latest Active Tracker
        // Record Current Location
        // look up kins men to know who to initiate , email or sms to

        $findAnyUserLastTracking = Tracker::where('user_id', $user_id)
                                        ->orderby('created_at','desc')->first();


        if($findAnyUserLastTracking)
        {
            DB::beginTransaction();
            $findAnyUserLastTracking->update(['status'=>'active']);
            $this->recordActiveTrackingSession($findAnyUserLastTracking->id , $locationDetails);
            $this->notificationTrigger($findAnyUserLastTracking->id);
            DB::commit();

            $response = ['success' => true , 'message' =>  'User Tracking started successfully'];
        }else{
            $response = ['success' => false , 'message' =>  'You have not initiated any active tracking'];
        }

        return  $response;
    }

    public function recordActiveTrackingSession($tracker_id , $locationDetails)
    {
        // TODO: Implement recordActiveTrackingSession() method.

        DB::beginTransaction();
        $recordTracking = new TrackingRecord();
        $recordTracking->tracker_id = $tracker_id;
        $recordTracking->longitude  = $locationDetails['longitude'];
        $recordTracking->latitude   = $locationDetails['latitude'];
        $recordTracking->location   = $locationDetails['location'];
        $recordTracking->destination_longitude   = $locationDetails['destination_longitude'] ?? null;
        $recordTracking->destination_latitude   = $locationDetails['destination_latitude'] ?? null;
        $recordTracking->notification_triger   = 'active';
        $recordTracking->save();
        DB::commit();

        return  $recordTracking;
    }

    public function  endActiveTrackingSession($tracker_id)
    {
        $tracker = Tracker::where('id',$tracker_id)->where('status','active')->first();


        if($tracker)
        {
            $data = [
                'start_time' => $tracker->created_at,
                'end_time' => $tracker->updated_at,
                'purpose_of_movement' => $tracker->purpose_of_movement
            ];
            $tracker->update(['status' => 'inactive']);
            $response = ['success' => true , 'message' =>  'You have ended this tracking session successfully', 'data' => $data];
        }else{
            $response = ['success' => true , 'message' =>  'An issue occurred while trying to end your tracking session , please try again'];
        }

       return  $response;
    }


    private function notificationTrigger($tracker_id)
    {

        $trackingRecord = TrackingRecord::where('tracker_id',$tracker_id)->where('notification_triger','active')->get();

        $findTrustee = UserTrustee::where('tracker_id',$tracker_id)->first();
        $tracker = Tracker::where('id',$tracker_id)->first();
        $findUserInitiatedTracking = $tracker->user;
        $otp = GenerateAuthorizationOtp::generate();
        $findTrustee->update(['code' => $otp]);
        $transactionId =  $tracker->transaction_id;



        switch(env('TRACKER_TRIGGER_NOTIFIER')) {
            case('email'):
                //only trigger email once
                if(count($trackingRecord) <= 1){
                   $this->triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id,  $transactionId);
                }
                $msg = "sent";
                break;
            case('sms'):
                $msg = '';
                $trustee_name =  $findTrustee->full_name;
                $tracked_user  =  $findUserInitiatedTracking->full_name;
                $phone_number =  $findTrustee->phone_number;
                if($transactionId != null)
                {
                    $getTransactionId = session()->get('isSet_transaction_id');
                    $url = env('APP_URL'). '/tracker/'.$tracker_id.'/user/'.$getTransactionId;
                    $msg .= 'Hi ' .$trustee_name .', the user with the name '.  $tracked_user . ' wants you to track is journey'."\n";
                    $msg .= "Link : " . $url . "\n";
                    $msg .= "Access Code : " . $otp;
                    $this->SendSms($phone_number,$msg);
                }else{
                    $url = env('APP_URL'). '/tracker/'.$tracker_id.'/user/';
                    $msg .= 'Hi ' .$trustee_name .', the user with the name '.  $tracked_user . ' wants you to track is journey'."\n";
                    $msg .= "Link : " . $url . "\n";
                    $msg .= "Access Code : " . $otp;
                    $this->SendSms($phone_number,$msg);
                }

                break;
            case('mixed'):
                $msg = '';
                $trustee_name =  $findTrustee->full_name;
                $tracked_user  =  $findUserInitiatedTracking->full_name;
                $phone_number =  $findTrustee->phone_number;
                if($transactionId != null)
                {
//                    $getTransactionId = session()->get('isSet_transaction_id');
                    $url = env('APP_URL'). '/tracker/'.$tracker_id.'/user/'.$transactionId;
                    $msg .= 'Hi ' .$trustee_name .', the user with the name '.  $tracked_user . ' wants you to track is journey'."\n";
                    $msg .= "Link : " . $url . "\n";
                    $msg .= "Access Code : " . $otp;
                    $this->SendSms($phone_number,$msg);
                }else{
                    $url = env('APP_URL'). '/tracker/'.$tracker_id.'/user/';
                    $msg .= 'Hi ' .$trustee_name .', the user with the name '.  $tracked_user . ' wants you to track is journey'."\n";
                    $msg .= "Link : " . $url . "\n";
                    $msg .= "Access Code : " . $otp;
                    $this->SendSms($phone_number,$msg);
                }
                if(count($trackingRecord) <= 1){
                    $this->triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id ,$transactionId);
                }
                break;
            default:
                if(count($trackingRecord) <= 1){
                    $this->triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id,$transactionId);
                }
                $msg = 'send just email.';
        }

        return $msg;

    }

    private function triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id , $transactionId)
    {

        if($transactionId != null)
        {
            $maildata = [
                'url' => env('APP_URL'). '/tracker/'.$tracker_id.'/user/'.$transactionId,
                'otp' => $otp,
                'trustee_name'=>  $findTrustee->full_name,
                'tracked_user' =>  $findUserInitiatedTracking->full_name,
            ];
        }else{
            $maildata = [
                'url' => env('APP_URL'). '/tracker/'.$tracker_id.'/user',
                'otp' => $otp,
                'trustee_name'=>  $findTrustee->full_name,
                'tracked_user' =>  $findUserInitiatedTracking->full_name,
            ];
        }


            Mail::to($findTrustee->email)->send(new TrackingNotificationTrigger($maildata));
    }


    public function SendSms($phone_number , $message)
    {
        SmsGateWayTrigger::triggerSms($phone_number , $message);
    }

}
