<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Mail\TourPackages;
use Illuminate\Http\Request;
use App\Models\Tour as TourPackage;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class Tour extends Controller
{
    public function tourPackageList()
    {


        $tours  = TourPackage::with('tourimages','service')->get();

        return response()->json(['success'=> true,'data' => compact('tours')]);
    }


    public function tourPackageShow($tour_id,$service_id)
    {

        $service = Service::where('id', $service_id)->firstorfail();

        $tour  = TourPackage::where('id',$tour_id)->with('tourimages')->first();

        return response()->json(['success' => true , 'data' => compact('tour','service')]);
    }


    public function addPayment(Request $request , $tour_id , $service_id)
    {
        request()->validate([
            'amount' => 'required'
        ]);

        $tour = TourPackage::where('id',$tour_id)->first();
        $service = Service::where('id', $service_id)->firstorfail();

        if((double) $tour->amount_regular == (double) $request->amount)
        {
            $amount = $tour->amount_regular;
            $type = 'Regular';

        }elseif((double) $tour->amount_standard == (double) $request->amount){

            $amount = $tour->amount_standard;
            $type = 'Standard';

        }else{

            abort('404');
        }

        return response()->json(['success' => true , 'data' => compact('amount','type','tour','service')]);
    }


    public function addCashPaymentTour(Request $request)
    {
        request()->validate([
            'tour_id' => 'required|integer',
            'tourType' => 'required|string',
            'amount' => 'required',
            'service_id' => 'required'
        ]);

        $tour = TourPackage::where('id', $request->tour_id)->firstorfail();


        if(strtolower($request->tourType) == 'regular')
        {

            $this->handlePayment($request->amount , $request->service_id , $tour);

            return  response()->json(['success' => true , 'message' => 'Success !! cash payment made successfully' ]);
        }elseif(strtolower($request->tourType) == 'standard')
        {
            $this->handlePayment($request->amount , $request->service_id , $tour);

            return  response()->json(['success' => true , 'message' => 'Success !! cash payment made successfully' ]);
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
        $transactions->tour_id = $trip->id;
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;

        $maildata = [
            'name' =>  $data['name'] ,
            'service' => 'Tour Package',
            'transaction' => $transactions
        ];


        Mail::to($data["email"])->send(new TourPackages($maildata));

        DB::commit();

    }

}
