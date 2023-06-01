<?php

namespace App\Http\new_Controllers;

use App\Models\Tracker;
use App\Models\TrackingRecord;
use App\Models\UserTrustee;
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
       $data['latitude'] = $trackingRecord[0]['latitude'];
       $data['longitude'] = $trackingRecord[0]['longitude'];

       if($transactionId != null)
       {
           $fetchTransaction = \App\Models\Transaction::where('id', $transactionId)
                                                ->with('schedule','service')
                                                ->select('service_id','schedule_id','tenant_id')->first();

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


    public function allTracking()
    {

        $trackers = Tracker::with('user')
                            ->orderBy('created_at','desc')
                            ->simplePaginate(20);

        if(!is_null(request()->tracking_id))
        {
            $trackers = Tracker::with('user')
                ->where('id',request()->tracking_id)
                ->simplePaginate(20);
         }

        if(!is_null(request()->tracking_status))
        {
            $trackers = Tracker::with('user')
                ->where('status',request()->tracking_status)
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_type))
        {
            $trackers = Tracker::with('user')
                ->where('tracking_type',request()->tracking_type)
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_type) && !is_null(request()->tracking_id))
        {

            $trackers = Tracker::with('user')
                                ->where(['tracking_type' => request()->tracking_type,'id' =>request()->tracking_id])
                                ->simplePaginate(20);

        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_id))
        {

            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'id' =>request()->tracking_id])
                ->simplePaginate(20);

        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_type))
        {
            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'tracking_type' =>request()->tracking_type])
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_type) &&  !is_null(request()->tracking_id))
        {
            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'tracking_type' =>request()->tracking_type , 'id' => request()->tracking_id])
                ->simplePaginate(20);
        }

        return view('admin.tracking.index',compact('trackers'));
    }

    public function viewEachTracking($tracking_id)
    {
        $locations = [];
        $records = TrackingRecord::where('tracker_id',$tracking_id)->orderBy('created_at','desc')->get();
        $nextOfKin = UserTrustee::where('tracker_id',$tracking_id)->first();
        $tracker = Tracker::where('id',$tracking_id)->first();

        foreach($records as $location)
        {
            $locations[]  =[$location->location,$location->latitude,$location->longitude ,$location->created_at->format('d F Y'), $location->created_at->format('H:i:s')];
        }

//        dd( $records);

        return view('admin.tracking.view-tracking',compact('nextOfKin','records','tracking_id','locations','tracker'));
    }

}
