<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;

class TrackingConsole extends Controller
{
    public function trackingPage($tracker_id)
    {


        $locations = [];

       $trackingRecord = \App\Models\TrackingRecord::where('tracker_id',$tracker_id)->select('location','longitude','latitude','created_at')->orderby('created_at','desc')->get();
       //use tracker to find User
       $trackedUser = Tracker::where('id',$tracker_id)->with('user')->first();


       foreach($trackingRecord as $location)
       {
           $locations[]  =[$location->location,$location->latitude,$location->longitude ,$location->created_at->format('d F Y'), $location->created_at->format('H:i:s')];
       }

        return view('pages.tracking.index', compact('locations','tracker_id','trackedUser'));
    }

}
