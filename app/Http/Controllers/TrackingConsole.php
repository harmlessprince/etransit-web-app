<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;

class TrackingConsole extends Controller
{
    public function trackingPage($tracker_id , $transactionId = null)
    {

       $locations = [];

       $trackingRecord = \App\Models\TrackingRecord::where('tracker_id',$tracker_id)->select('location','longitude','latitude','created_at')->orderby('created_at','desc')->get();
       //use tracker to find User
       $trackedUser = Tracker::where('id',$tracker_id)->with('user')->first();

       $data['destinationTerminal'] = null;
       $data['pickupTerminal'] = null;
       $data['purposeOfMovement'] = null;
       $data['pickup'] = null;
       $data['destination'] = null;
       $data['departureTime'] = null;
        $data['departureDate'] = null;

       if($transactionId != null)
       {
           $fetchTransaction = \App\Models\Transaction::where('id', $transactionId)
                                                ->with('schedule','service')
                                                ->select('service_id','schedule_id')->first();

           if( $fetchTransaction->service_id == 1)
           {
               //bus booking tracking only
               $data['pickup']            =  $fetchTransaction->schedule->pickup->location ;
               $data['destination']       =  $fetchTransaction->schedule->destination->location;
               $data['departureTime']     =  $fetchTransaction->schedule->departure_time;
               $data['departureDate']     =  $fetchTransaction->schedule->departure_date;
               $data['purposeOfMovement'] =  $trackedUser->purpose_of_movement;
           }

       }


       foreach($trackingRecord as $location)
       {
           $locations[]  =[$location->location,$location->latitude,$location->longitude ,$location->created_at->format('d F Y'), $location->created_at->format('H:i:s')];
       }

        return view('pages.tracking.index', compact('locations','tracker_id','trackedUser','data'));
    }

}
