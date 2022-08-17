<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingConsole extends Controller
{
    public function trackingPage($tracker_id)
    {

        // $locations = [
        //     ['Lagos',6.5244 , 3.3792],
        //     ['Ibadan',7.3775 ,3.9470],
        //     ['Osogbo',7.7827 ,4.5418],
        // ];
        $locations = [];
//       $loc = ['data' ,236363,37373773];
       $trackingRecord = \App\Models\TrackingRecord::where('tracker_id',$tracker_id)->select('location','longitude','latitude')->get();

       foreach($trackingRecord as $location)
       {
           $locations[]  =[$location->location,$location->latitude,$location->longitude];
       }

        return view('pages.tracking.index', compact('locations'));
    }

}
