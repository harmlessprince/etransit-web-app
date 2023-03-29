<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use App\Mail\BoatCruiseBooking;
use App\Models\Boat;
use App\Models\BoatImage;
use App\Models\BoatTrip;
use App\Models\CruiseDestination;
use App\Models\Service;
use App\Notifications\AdminOtherBookings;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use PDF;

class BoatCruise extends Controller
{
    public function boatCruiseList()
    {

        $service = Service::where('id', 7)->firstorfail();

        $boatCruise = BoatTrip::with('boat','cruiselocation')->get();


        if(!is_null(request()->locations))
        {
            $boatCruise = BoatTrip::whereIn('cruise_destination_id',request()->locations)->with('boat','cruiselocation')->get();
        }

        if(!is_null(request()->boat_dates))
        {
            $boatCruise = BoatTrip::whereIn('departure_date',request()->boat_dates)->with('boat','cruiselocation')->get();
        }

        if(!is_null(request()->boat_dates) && !is_null(request()->locations))
        {
            $boatCruise = BoatTrip::whereIn('departure_date',request()->boat_dates)->whereIn('cruise_destination_id',request()->locations)->with('boat','cruiselocation')->get();
        }

        $locations = CruiseDestination::all();


        return view('pages.boat-cruise.list', compact('service','boatCruise','locations'));
    }

    public function filterBoatTripSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = BoatTrip::where('cruise_name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }


    public function boatCruiseShow($id)
    {
        $service = Service::where('id', 7)->firstorfail();
        $locations = CruiseDestination::all();
        $boat = BoatTrip::where('id', $id)->with('boat','cruiselocation')->first();

        return view('pages.boat-cruise.show', compact('service','boat','locations'));
    }


    public function index()
    {

        $boats = Boat::all();

        return view("admin.boat-cruise.index", compact('boats'));
    }


    public function addBoat()
    {

        $service = Service::where('id', 7)->firstorfail();
        return view("admin.boat-cruise.store", compact('service'));
    }


    public function storeBoat(request $request)
    {
        request()->validate([
            'boat_name' => 'required',
            'description' => 'required'
        ]);

        if($request->hasfile('images'))
        {

            DB::beginTransaction();

            $boat = new Boat();
            $boat->name = $request->boat_name;
            $boat->service_id = $request->service_id;
            $boat->description = $request->description;
            $boat->save();

            $images = array();

            if(count($request->file('images')) < 2)
            {
                Alert::error('Warning ', 'Please Upload at least two images');

                return back();
            }


            if($files = $request->file('images')){

                foreach($files as  $file){
                    $request->validate([
                        'images' => 'required|array',
                        'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                    ]);
                    $name = $file->getClientOriginalName();
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    array_push($images ,  $uploadedFileUrl);

                }
                $imagePath = json_encode($images);

                $boat->update([
                    'paths' => $imagePath,
                ]);


            }
        }

        DB::commit();

        Alert::success('Success ', 'Boat added successfully');

        return back();
    }


    public function boatHistory($boat_id)
    {
        $boatHistory = Boat::where('id', $boat_id)->firstorfail();

        return view('admin.boat-cruise.history', compact('boatHistory'));
    }

    public function viewBoatSchedulesPaymentHistory($schedule_id)
    {
        $transactions = \App\Models\Transaction::where('boat_trip_id',$schedule_id)->with('user')->simplePaginate();
        $transactionCount = \App\Models\Transaction::where('boat_trip_id',$schedule_id)->count();
        $transactionSum = \App\Models\Transaction::where('boat_trip_id',$schedule_id)->pluck('amount')->sum();

        return view('admin.boat-cruise.schedule-transactions', compact('transactions','transactionCount','transactionSum'));
    }

    public function viewBoatSchedules($boat_id)
    {
        $schedules = BoatTrip::where('boat_id',$boat_id)->with('boat')->orderBy('created_at','desc')->simplePaginate();

        return view('admin.boat-cruise.boat-schedules' , compact('schedules'));

    }

    public function editBoat($boat_id)
    {
        $boat = Boat::where('id', $boat_id)->firstorfail();

        $images = json_decode($boat->paths , true);

        if(!is_array($images))
        {
            $images = $boat->paths;

        }else{
            $images =  json_decode($boat->paths , true);
        }

        return view('admin.boat-cruise.edit', compact('boat', 'images'));
    }

    public function updateBoat(Request $request , $boat_id)
    {
        request()->validate([
            'boat_name' => 'required',
            'description' => 'required'
        ]);
        DB::beginTransaction();

        $updateBoat =   Boat::where('id', $boat_id)->firstorfail();

        $updateBoat->update([
            'name' => $request->boat_name,
            'description' => $request->description
        ]);

        $images = array();




        if($files = $request->file('images')){

            if(count($request->file('images')) < 2)
            {
                Alert::error('Warning ', 'Please Upload at least two images');

                return back();
            }

            foreach($files as $index =>  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();

                array_push($images , $uploadedFileUrl);

            }
            $boatImages = json_encode($images , true);
            $boatImage = Boat::where('id',$boat_id)->firstorfail();
            $boatImage->update([
                'paths'   => $boatImages,
            ]);
        }
        DB::commit();

        Alert::success('Success ', 'Update  successfully');

        return back();
    }


    public function schedule($boat_id)
    {
        $boat = Boat::where('id',$boat_id)->firstorfail();
        $locations = CruiseDestination::all();

        return view("admin.boat-cruise.schedule",compact('boat','locations'));
    }

    public function addBoatSchedule(Request $request)
    {

            request()->validate([
                'time'         => 'required',
                'cruise_name'  => 'required',
                'event_start'  => 'required',
                'max_amount'   => 'required',
                'min_amount'   => 'required',
                'destination'  => 'required|integer',
                'description'  => 'required',
                'duration'     => 'required'
            ]);


        $eventDate  = strtotime($request->event_start);
//        $Eventdate =  date('d-M-Y',  $eventDate);
//        $now = now()->format('d-M-Y');
        try {
            DB::beginTransaction();
                $boatTrip = new BoatTrip();
                $boatTrip->cruise_name              = $request->cruise_name;
                $boatTrip->min_amount               = $request->min_amount;
                $boatTrip->max_amount               = $request->max_amount;
                $boatTrip->departure_time           = $request->time;
                $boatTrip->description              = $request->description;
                $boatTrip->departure_date           = $request->event_start;
                $boatTrip->cruise_destination_id    = $request->destination;
                $boatTrip->boat_id                  = $request->boatID;
                $boatTrip->duration                 = $request->duration;
                $boatTrip->tenant_id                = session()->get('tenant_id');
                $boatTrip->save();
            DB::commit();
            return response()->json(['success' => true , 'message' => 'Boat Cruise Event has been scheduled successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false , 'message' => 'Could not save the event .Try again']);

        }

    }

    public function addCruiseLocation()
    {
        $locations  = CruiseDestination::all();

        return view("admin.boat-cruise.location",compact('locations'));
    }

    public function storeCruiseLocation(Request $request)
    {
        request()->validate([
            'location' => 'required'
        ]);

        try {
            DB::beginTransaction();
                $location = new CruiseDestination();
                $location->destination  = $request->location;
                $location->save();
            DB::commit();
            return response()->json(['success' => true , 'message' => 'Boat Cruise location added  successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false , 'message' => 'Could not save the event .Try again']);

        }
    }

    public function addPayment(Request $request ,$boat_id , $service_id)
    {
        request()->validate([
            'amount' => 'required'
        ]);

        $trip = BoatTrip::where('id',$boat_id)->with('boat','cruiselocation')->first();
        $service = Service::where('id', 7)->firstorfail();

        if((double) $trip->min_amount == (double) $request->amount)
        {
            $amount = $trip->min_amount;
            $type = 'Regular';
        }elseif((double) $trip->max_amount == (double) $request->amount){
            $amount = $trip->max_amount;
            $type = 'Standard';
        }else{

            abort('404');
        }

        return view('pages.boat-cruise.payment', compact('amount','type','trip','service'));
    }

    public function addCashPayment(Request $request)
    {

       $findTrip = BoatTrip::where('id', $request->boatTrip_id)->firstorfail();


       if(strtolower($request->cruiseType)== 'regular')
       {

           $this->handlePayment($request->amount , $request->service_id , $findTrip);

           toastr()->success('Success !! cash payment made successfully');
           return  redirect('/');
       }elseif(strtolower($request->cruiseType) == 'standard')
       {
           $this->handlePayment($request->amount , $request->service_id , $findTrip);
           toastr()->success('Success !! cash payment made successfully');
           return  redirect('/');
       }else{
           abort('404');
       }

    }

    private function handlePayment($amount , $serviceId , $trip)
    {
        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = $reference;
        $transactions->amount = (double) $amount;
        $transactions->status = 'Pending';
        $transactions->description = 'Cash Payment of ' . $amount .' paid successfully at ' . now()->format('Y F d : h:i:s');
        $transactions->user_id = auth()->user()->id;
        $transactions->service_id = $serviceId;
        $transactions->boat_trip_id = $trip->id;
        $transactions->transaction_type = "cash payment";
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;
        $data["title"] = env('APP_NAME').' Boat Cruise Receipt';
        $data["body"]  = "This is Demo";

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Boat Cruise',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' => $amount,
            'cruise_name' => $trip->cruise_name,
            'cruise_destination' => $trip->cruiselocation->destination,
            'boat_name' => $trip->boat->name,
            'departure_date' => $trip->departure_date->format('M-d-Y'),
            'departure_time' => $trip->departure_time->format('h:i:s')
        ];

        $email = auth()->user()->email;

        Mail::to($email)->send(new BoatCruiseBooking($maildata));
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();

    }


    public function editBoatLocation($id)
    {

        $boatLocation =  CruiseDestination::where('id',$id)->first();

        return view('admin.boat-cruise.edit-boat-location' , compact('boatLocation'));
    }

    public function updateBoatLocation(Request $request , $id)
    {
        $request->validate([
            'boat_location' => 'required'
        ]);

        $carTypeEdit =  CruiseDestination::where('id',$id)->first();
        $carTypeEdit->update([
            'destination' => $request->boat_location
        ]);

        Alert::success('Success ', 'Boat Location Updated successfully');
        return back();

    }
    public function allBoats() 
    {
        // $service = Service::where('id', 7)->firstorfail();
        $boatCount = Boat::count();
        $boatCruiseCount = BoatTrip::count();
        $boats = Boat::where('tenant_id', session()->get('tenant_id'))->get();

        return view('Eticket.boat.all-boats', compact('boatCount', 'boatCruiseCount', 'boats'));
    }

    public function addNewBoat()
    {
        return view('Eticket.boat.add-new-boat');
    }
    public function postNewBoat(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        $newBoat = new Boat;
        $newBoat->name = $request->name;
        $newBoat->location ? $newBoat->location = $request->location : '';
        $newBoat->description = $request->description;
        $request->paths ? $newBoat->paths = $request->paths : ' ';
        $newBoat->service_id = 7;
        $newBoat->tenant_id = session()->get('tenant_id');
        $newBoat->save();

        $images = array();

        if(!$request->file('images'))
        {
            Alert::error('Warning ', 'Please Upload boat images');

            return back();
        }

        if($files = $request->file('images')){

            foreach($files as  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $boatImage = new BoatImage();
                $boatImage->boat_id = $newBoat->id;
                $boatImage->path = $uploadedFileUrl;
                $boatImage->save();
            }

        }

        DB::commit();

        Alert::success('Success ', 'Boat added successfully');
        return redirect('e-ticket/boats');
    }
    public function allBoatTrips()
    {
        $service = Service::where('id', 7)->firstorfail();
        $boatCruises = BoatTrip::with('boat', 'cruiselocation')->where('tenant_id', session()->get('tenant_id'))->get();
        return view('Eticket.boat.all-boat-cruise-trips', compact('service', 'boatCruises'));
    }
   
    public function cruiseDestinations()
    {
        $destinations = CruiseDestination::all(); 
        return view('Eticket.boat.cruise-destinations', compact('destinations'));
    }
    public function viewBoat($boat_id)
    {
        $id = $boat_id;
        $boat = Boat::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
        $boat_images = BoatImage::where('boat_id', $id)->get();
        if($boat->tenant_id = session()->get('tenant_id')){
        return view('Eticket.boat.view-boat', compact('boat', 'boat_images'));
        }
    }
    public function eticketEditBoat($boat_id)
    {
        $id = $boat_id;
        $boat = Boat::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
        $boat_images = BoatImage::where('boat_id', $id)->get();
        if($boat->tenant_id = session()->get('tenant_id')){
        return view('Eticket.boat.edit-boat', compact('boat', 'boat_images'));
        }
    }
    public function eticketUpdateBoat(Request $request, $boat_id)
    {
        $data  = request()->validate([
            'name' => 'required',
            'location' => 'required',
            'description'=> 'required',
        ]);

        DB::beginTransaction();

        $updatedBoat = Boat::where('id', $boat_id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
        $updatedBoat->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'paths' => $request->paths,
            'service_id' => 7,
            'tenant_id' => session()->get('tenant_id')
        ]);

        $images = array();
        if($files = $request->file('images')){

            foreach($files as  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $boatImage = new BoatImage();
                $boatImage->boat_id = $newBoat->id;
                $boatImage->path = $uploadedFileUrl;
                $boatImage->save();
            }

        }
        DB::commit();

        Alert::success('Success ', 'Boat updated successfully');

        return  redirect('e-ticket/view-boat/'.$boat_id);

    }
    public function scheduleBoatTrip($boat_id)
    {
        $id = $boat_id;
        $boat = Boat::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
        $locations = CruiseDestination::all();
        return view('Eticket.boat.schedule-boat-trip', compact('boat', 'locations'));
    }
    public function saveCruiseDestination(Request $request)
    {
        request()->validate([
            'destination' => 'required',
        ]);
        $newDestination = CruiseDestination::firstOrCreate(['destination' => $request->destination]);
        Alert::success('Success ', 'Destination saved successfully');
        return  redirect('e-ticket/boats/cruise-destinations/');
    }
    public function deleteCruiseDestination($id)
    {
        $destination = CruiseDestination::find($id);
        $destination->delete();
        Alert::success('Success ', 'Destination successfully deleted');
        return  redirect('e-ticket/boats/cruise-destinations/');

    }
    public function updateCruiseDestination(Request $request, $id)
    {
        request()->validate([
            'destination' => 'required',
        ]);
        $destination = CruiseDestination::findOrFail($id);
        $destination->destination = $request->destination;
        $destination->save();

        Alert::success('Success ', 'Destination updated!');
        return  redirect('e-ticket/boats/cruise-destinations/');
    }
    public function eticketDeleteBoat($id)
    {
        $boat = Boat::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
          $boat->delete();
          Alert::success('Success ', 'Boat successfully deleted');
        
        return  redirect('e-ticket/boats/');
    }
    public function deleteBoatTrip($id)
    {
        $boatTrip = BoatTrip::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();
        $boatTrip->delete();
        Alert::success('Success ', 'Boat cruise successfully deleted');
        
        return  redirect('e-ticket/all-boat-trips/');
    }
    public function editBoatTrip($id)
    {
        $locations = CruiseDestination::all();
        $boatTrip = BoatTrip::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->with(['cruiselocation', 'boat'])->firstOrFail();

        return view('Eticket.boat.edit-boat-cruise', compact('boatTrip', 'locations'));       
    }

    public function updateBoatSchedule(Request $request, $id)
    {

            request()->validate([
                'cruise_name'  => 'required',
                'amount_max'   => 'required',
                'amount_min'   => 'required',
                'description'  => 'required',
                'duration'     => 'required',
            ]);

            $boatTrip = BoatTrip::where('id', $id)->where('tenant_id', session()->get('tenant_id'))->firstOrFail();;
                $boatTrip->cruise_name              = $request->cruise_name;
                $boatTrip->min_amount               = $request->amount_min;
                $boatTrip->max_amount               = $request->amount_max;
                $boatTrip->description              = $request->description;
                $boatTrip->duration                 = $request->duration;
                $boatTrip->boat_id                  = $request->boat_id;
                $boatTrip->tenant_id                = session()->get('tenant_id');
                if($request->time) {$boatTrip->departure_time = $request->time;}
                if($request->departure_date) {$boatTrip->departure_date = $request->departure_date;}
                if($request->destination) {$boatTrip->cruise_destination_id = $request->destination;}
                $boatTrip->save();

            Alert::success('Success ', 'Boat cruise successfully updated');
            return  redirect('e-ticket/all-boat-trips/');        
    }
}
