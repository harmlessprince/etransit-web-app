<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TrackingInterface;
use App\Models\Passenger;
use App\Models\Tracker;
use App\Models\TrackingRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrackingConsole extends Controller
{
    private TrackingInterface $trackingRepository;

    public function __construct(TrackingInterface $trackingRepository)
    {
        $this->trackingRepository = $trackingRepository;
    }


    public function trackUser(Request $request,$transaction_id = null) : JsonResponse
    {
        $trackingDetails = $request->validate([
                'purpose_of_movement' => 'required',
                'destination_description' => 'required',
                'next_of_kin_name'=> 'required',
                'next_of_kin_email' => 'sometimes',
                'next_of_kin_phone_number' => 'required',
                'tracking_type' => 'required',
            ]);


        $trackingIsInitiated =  $this->trackingRepository->trackUser(auth()->user()->id ,$trackingDetails , $transaction_id);

        if(!$trackingIsInitiated)
        {
            return response()->json(['success' => false , 'message' =>  $trackingIsInitiated['message']]);
        }

        return response()->json(['success' => true , 'message' => 'tracking set successfully','data' => compact('trackingIsInitiated')]);
    }


    public function initiateTracking(Request $request)
    {
      $data =  $this->validateRequest($request);;

      $startTracking =  $this->trackingRepository->initiateTracking(auth()->user()->id ,$data);

      if(!$startTracking['success'])
      {
          return response()->json(['success' => false , 'message' => $startTracking['message']]);
      }

        return response()->json(['success' => true , 'message' => $startTracking['message']]);

    }


    public function recordActiveTracking(Request $request , $tracker_id)
    {
        $data =  $this->validateRequest($request);;

        $recordActiveTracking  =  $this->trackingRepository->recordActiveTrackingSession($tracker_id ,$data);

        if($recordActiveTracking)
        {
            return response()->json(['success' => true , 'message' => 'New Tracking session recorded successfully']);
        }

        return response()->json(['success' => false , 'message' => 'Unable to add new Tracking session record successfully']);

    }


    public function endActiveTrackingSession($tracker_id)
    {
        $endActiveTracking  =  $this->trackingRepository-> endActiveTrackingSession($tracker_id);

        if($endActiveTracking)
        {
            return response()->json(['success' => true , 'message' =>  $endActiveTracking['message']]);
        }else{
            return response()->json(['success' => true , 'message' =>  $endActiveTracking['message']]);
        }

    }

    public function previousTrackingSessions($limit=20)
    {
        $user = auth()->user();

        $findPreviousTrackingSession = Tracker::where('user_id',$user->id)
                                                ->where('status','inactive')
                                                ->simplepaginate($limit);

        return response()->json(['success' => true , 'data' => compact('findPreviousTrackingSession')]);
    }

    public function activeSessionTracking($limit=20)
    {
        $user = auth()->user();

        $findActiveTrackingSession = Tracker::where('user_id',$user->id)
            ->where('status','active')
            ->simplepaginate($limit);

        return response()->json(['success' => true , 'data' => compact('findActiveTrackingSession')]);
    }


    public function TrackingRecord($tracker_id , $limit=20)
    {
        $trackingRecords = TrackingRecord::where('tracker_id',$tracker_id)->simplePaginate($limit);

        return response()->json(['success' => true , 'data' => compact('trackingRecords')]);
    }

    public function prefillTrusteeInfo($transaction_id)
    {
        $transaction = Transaction::where('id',$transaction_id)
                            ->select('schedule_id','service_id')->first();
        $data['name'] = null;
        $data['phone_number'] = null;
        if($transaction->service_id == 1)
        {
            $fetchPassengerTrustee = Passenger::where('schedule_id',$transaction->schedule_id)->first();
            $data['name'] =  $fetchPassengerTrustee->next_of_kin_name;
            $data['phone_number'] =  $fetchPassengerTrustee-> next_of_kin_number;
        }

        return response()->json(['success' => true , 'data' => compact('data')]);
    }



    private function validateRequest($request)
    {
      $data =  $request->validate([
                    'longitude' => 'required',
                    'latitude' => 'required',
                    'location' => 'required'
              ]);

      return $data;
    }

}
