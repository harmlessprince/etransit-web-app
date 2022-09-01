<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TrackingInterface;
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


    public function trackUser(Request $request) : JsonResponse
    {
        $trackingDetails = $request->validate([
                'purpose_of_movement' => 'required',
                'destination_description' => 'required',
                'next_of_kin_name'=> 'required',
                'next_of_kin_email' => 'required',
                'next_of_kin_phone_number' => 'required',
                'tracking_type' => 'required',
            ]);


        $trackingIsInitiated =  $this->trackingRepository->trackUser(auth()->user()->id ,$trackingDetails);

        return response()->json(['success' => true , 'message' => 'tracking set successfully']);
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
