<?php

namespace App\Http\new_Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Tracker;
use App\Models\TrackingRecord;
use App\Models\UserTrustee;
use Illuminate\Http\Request;

class TrackingConsole extends Controller
{
    public function allTracking()
    {

        $trackers = Tracker::with('user')
                        ->where('tenant_id',session()->get('tenant_id'))
                        ->orderBy('created_at','desc')
                        ->simplePaginate(20);

        if(!is_null(request()->tracking_id))
        {
            $trackers = Tracker::with('user')
                ->where('tenant_id',session()->get('tenant_id'))
                ->where('id',request()->tracking_id)
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_status))
        {
            $trackers = Tracker::with('user')
                ->where('tenant_id',session()->get('tenant_id'))
                ->where('status',request()->tracking_status)
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_type))
        {
            $trackers = Tracker::with('user')
                ->where('tenant_id',session()->get('tenant_id'))
                ->where('tracking_type',request()->tracking_type)
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_type) && !is_null(request()->tracking_id))
        {

            $trackers = Tracker::with('user')
                ->where(['tracking_type' => request()->tracking_type,'id' =>request()->tracking_id ,
                    'tenant_id' => session()->get('tenant_id')])
                ->simplePaginate(20);

        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_id))
        {

            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'id' =>request()->tracking_id ,
                    'tenant_id' => session()->get('tenant_id')])
                ->simplePaginate(20);

        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_type))
        {
            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'tracking_type' =>request()->tracking_type ,
                    'tenant_id' => session()->get('tenant_id')])
                ->simplePaginate(20);
        }

        if(!is_null(request()->tracking_status) && !is_null(request()->tracking_type) &&  !is_null(request()->tracking_id))
        {
            $trackers = Tracker::with('user')
                ->where(['status' => request()->tracking_status,'tracking_type' =>request()->tracking_type , 'id' => request()->tracking_id,
                    'tenant_id' => session()->get('tenant_id')])
                ->simplePaginate(20);
        }

        return view('Eticket.tracking.index',compact('trackers'));
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

        return view('Eticket.tracking.view-tracking',compact('nextOfKin','records','tracking_id','locations','tracker'));
    }
}
