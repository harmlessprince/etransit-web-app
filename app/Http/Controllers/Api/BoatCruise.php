<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\Boat;
use App\Models\BoatTrip;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class BoatCruise extends Controller
{
    public function boatCruiseList()
    {


      $boatCruise =  Boat::whereHas('trips')->with(['boatimages', 'trips' => function($query) {
                                                         $query->with('cruiselocation')->get();}])->get();

        return response()->json(['success' => true ,'data'=> compact('boatCruise')]);
    }

    public function boatCruiseShow($trip_id)
    {
        $service = Service::where('id', 7)->firstorfail();
        $boat = BoatTrip::where('id', $trip_id)->with('boat','cruiselocation')->first();

        return response()->json(['success' => true ,'data' => compact('service','boat')]);
    }

    public function addCashPayment(Request $request)
    {

        $findTrip = BoatTrip::where('id', $request->boatTrip_id)->firstorfail();


        if(strtolower($request->cruiseType)== 'regular')
        {

             $this->handlePayment($request->amount , $request->service_id , $findTrip);

            return  response()->json(['success'=> true , 'message' => 'Success !! cash payment made successfully']);

        }elseif(strtolower($request->cruiseType) == 'standard')
        {
            $this->handlePayment($request->amount , $request->service_id , $findTrip);

            return  response()->json(['success'=> true , 'message' => 'Success !! cash payment made successfully']);
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


    public function addPayment(Request $request ,$trip_id , $service_id)
    {
        request()->validate([
            'amount' => 'required'
        ]);

        $trip = BoatTrip::where('id',$trip_id)->with('boat','cruiselocation')->first();
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

        return response()->json(['success'=> true ,'data' => compact('amount','type','trip','service')]);
    }


}
