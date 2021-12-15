<?php

namespace App\Http\Controllers;

use App\Models\FerryImage;
use App\Models\FerryLocation;
use App\Models\FerrySeat;
use App\Models\FerryTrip;
use App\Models\FerryType;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Ferry as FerryBoat;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Ferry extends Controller
{
    public function index()
    {
        $ferries = FerryBoat::all();
        return view('admin.ferry.index' , compact('ferries'));
    }


    public function create()
    {
        $service = Service::where('id' , 3)->firstorfail();

        $ferryTypes = FerryType::all();

        return view('admin.ferry.create', compact('service','ferryTypes'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'ferry_name'  => 'required',
            'ferry_type'  => 'required|integer',
            'description' => 'required',
            'seats'       => 'required|integer',
            'coach_type'  => 'required|array',
            'coach_seats' => 'required|array',
            'images'      => 'required|array',
            'images.*'    => '|mimes:jpg,jpeg,png|max:4048',
        ]);

        DB::beginTransaction();
        $ferry                  = new FerryBoat();
        $ferry->name            = $request->ferry_name;
        $ferry->ferry_type_id   = $request->ferry_type;
        $ferry->occupants       = $request->seats;
        $ferry->service_id      = $request->service_id;
        $ferry->description     = $request->description;
        $ferry->save();

        $coachTypeCount = count($request->coach_type);
        $coachSeatCount = count($request->coach_seats);

        if($coachTypeCount != $coachSeatCount)
        {
            Alert::error('Warning ', 'Please ensure each coach has seat allocated to them');
            return back();
        }

       $CoachAllocatedSeat =array_sum($request->coach_seats);

        if($CoachAllocatedSeat != $request->seats)
        {
            Alert::error('Oops !!!', 'Seems your ferry seat is less or more than number of seats allocated to each coach');
            return back();
        }

       foreach($request->coach_type as $index => $seat)
       {
           $coachType       = $request->coach_type[$index];
           $numberOfSeats   = $request->coach_seats[$index];
           for($i = 0 ; $i < (int) $numberOfSeats; $i++ )
           {
               $ferrySeatTracker               = new FerrySeat();
               $ferrySeatTracker->ferry_id     = $ferry->id;
               $ferrySeatTracker->coach_type   = $coachType;
               $ferrySeatTracker->coach_number =  $i+1;
               $ferrySeatTracker->save();
           }

       }


        $images = array();
        if($files = $request->file('images')) {
            foreach ($files as $index => $file) {
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $ferrImage = new FerryImage();
                $ferrImage->ferry_id = $ferry->id;
                $ferrImage->path = $uploadedFileUrl;
                $ferrImage->save();
            }
        }
        DB::commit();

        Alert::success('Success', 'Ferry Added Successfully');

        return back();
    }

    public function types()
    {
        $ferryTypes = FerryType::all();

        return view('admin.ferry.type' , compact('ferryTypes'));
    }

    public function storeFerryType(Request $request)
    {
        request()->validate(['ferry_type' => 'required']);

        $type = new FerryType();
        $type->name = $request->ferry_type;
        $type->save();

        return response()->json(['success' => true ,'message' => 'Ferry Type added successfully']);
    }

    public function ferryLocations()
    {
        $locations = FerryLocation::all();
        return view('admin.ferry.locations', compact('locations'));
    }


    public function storeLocation(Request $request)
    {
        request()->validate(['location' => 'required']);

        $location = new FerryLocation();
        $location->locations = $request->location;
        $location->save();

        return response()->json(['success' => true , 'message' => 'Location added successfully']);
    }

    public function schedule($ferry_id)
    {
        $ferry = FerryBoat::where('id' , $ferry_id)->with('ferrytype')->firstorfail();
        $locations = FerryLocation::all();

        return view('admin.ferry.schedule' , compact('ferry','locations'));
    }

    public function scheduleEvent(Request $request)
    {
       $ferry = FerryBoat::where('id' , $request->ferryId)->with('ferrytype')->firstorfail();
       $trips = new FerryTrip();
       $trips->ferry_id = $request->ferryId;
       $trips->ferry_pick_up_id = $request->pickUp;
       $trips->ferry_destination_id = $request->destination;
       $trips->amount_adult = $request->Tfare;
       $trips->amount_children = $request->TfareChild;
       $trips->trip_duration   = $request->duration;
       $trips->trip_description  = $request->description;
       $trips->event_date = $request->event_start;
       $trips->event_time = $request->departureTime;
       $trips->number_of_passengers = $ferry->occupants;
       $trips->ferry_type_id = $ferry->ferrytype->id;
       $trips->save();

       return response()->json(['success' => true , 'message' => 'Data saved successfully']);

    }

    public function ferryHistory($ferry_id)
    {

    }
}
