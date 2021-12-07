<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use App\Models\Boat;
use App\Models\BoatImage;
use App\Models\BoatTrip;
use App\Models\CruiseDestination;
use App\Models\Service;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BoatCruise extends Controller
{
    public function boatCruiseList()
    {

        $service = Service::where('id', 7)->firstorfail();

        $boatCruise = BoatTrip::with('boat','cruiselocation')->get();
//        dd($boatCruise->boat->boatimages[0]->path);

//dd( $boatCruise);
        return view('pages.boat-cruise.list', compact('service','boatCruise'));
    }


    public function boatCruiseShow($id)
    {
        $service = Service::where('id', 7)->firstorfail();
        $boat = BoatTrip::where('id', $id)->with('boat','cruiselocation')->first();

        return view('pages.boat-cruise.show', compact('service','boat'));
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

            if($files = $request->file('images')){

                foreach($files as  $file){
                    $request->validate([
                        'images' => 'required|array',
                        'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                    ]);
                    $name = $file->getClientOriginalName();
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    $boatImage = new BoatImage();
                    $boatImage->boat_id = $boat->id;
                    $boatImage->path = $uploadedFileUrl;
                    $boatImage->save();
                }

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

    public function editBoat($boat_id)
    {
        $boat = Boat::where('id', $boat_id)->with('boatimages')->firstorfail();

        return view('admin.boat-cruise.edit', compact('boat'));
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

            foreach($files as $index =>  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $boatImage = BoatImage::where('boat_id',$boat_id)->get();
                $boatImage[$index]->update([
                    'boat_id' => $boat_id,
                    'path'   => $uploadedFileUrl,
                ]);
            }
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
        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->amount = (double) $amount;
        $transactions->status = 'Pending';
        $transactions->description = 'Cash Payment';
        $transactions->user_id = auth()->user()->id;
        $transactions->service_id = $serviceId;
        $transactions->boat_trip_id = $trip->id;
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;
        $data["title"] = env('APP_NAME').' Boat Cruise Receipt';
        $data["body"]  = "This is Demo";

        $pdf = PDF::loadView('pdf.car-hire', $data);

        Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "receipt.pdf");
        });

        DB::commit();





    }

//    protected function checkAmount($exactAmount , $paidAmount)
//    {
//        if((double)  $exactAmount != (double) $paidAmount)
//        {
//            toastr()->error('Oops !! something went wrong with your payment');
//            return back();
//        }
//    }
}
