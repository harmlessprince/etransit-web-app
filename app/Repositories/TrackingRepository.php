<?php

namespace App\Repositories;

use App\Classes\GenerateAuthorizationOtp;
use App\Interfaces\TrackingInterface;
use App\Mail\TrackingNotificationTrigger;
use App\Models\Tracker;
use App\Models\TrackingRecord;
use App\Models\UserTrustee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TrackingRepository implements TrackingInterface
{
    public function trackUser($userId , $trackingDetails)
    {
        DB::beginTransaction();
        $tracker = new Tracker();
        $tracker->user_id = $userId;
        $tracker->tracking_type = $trackingDetails['tracking_type'];
        $tracker->purpose_of_movement =  $trackingDetails['purpose_of_movement'];
        $tracker->destination_description =  $trackingDetails['destination_description'];
        $tracker->save();
        if($tracker)
        {
            $trustee = new UserTrustee();
            $trustee->full_name = $trackingDetails['next_of_kin_name'];
            $trustee->email = $trackingDetails['next_of_kin_email'];
            $trustee->phone_number = $trackingDetails['next_of_kin_phone_number'];
            $trustee->tracker_id  = $tracker->id;
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
            $tracker->update(['status' => 'inactive']);
            $response = ['success' => true , 'message' =>  'You have ended this tracking session successfully'];
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



        switch(env('TRACKER_TRIGGER_NOTIFIER')) {
            case('email'):
                //only trigger email once
                if(count($trackingRecord) <= 1){
                   $this->triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id);
                }
                $msg = "sent";
                break;
            case('sms'):
                $msg = 'send sms only';
                break;
            case('mixed'):
                $msg = 'Send both sms and email';
                break;
            default:
                if(count($trackingRecord) <= 1){
                    $this->triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id);
                }
                $msg = 'send just email.';
        }

        return $msg;

    }

    private function triggerEmail($findTrustee,$otp,$findUserInitiatedTracking,$tracker_id)
    {
            $maildata = [
                'url' => env('APP_URL'). '/tracker/'.$tracker_id.'/user',
                'otp' => $otp,
                'trustee_name'=>  $findTrustee->full_name,
                'tracked_user' =>  $findUserInitiatedTracking->full_name,
            ];

            Mail::to($findTrustee->email)->send(new TrackingNotificationTrigger($maildata));


    }

}
