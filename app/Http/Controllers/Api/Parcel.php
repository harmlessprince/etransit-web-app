<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\DeliveryParcel;
use App\Models\Height;
use App\Models\Length;
use App\Models\State;
use App\Models\Weight;
use App\Models\Width;
use Illuminate\Http\Request;
use App\Models\Parcel as ParcelPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class Parcel extends Controller
{
    public function fetchParcel()
    {
        $parcels = ParcelPackage::all();

        $states = State::all();

        return response()->json(['success' => true , 'data' => compact('parcels','states')]);
    }

    public function fetchStates()
    {
        $states = State::all();

        return response()->json(['success' => true , 'data' => compact('states')]);
    }
    public function fetchCities($state_id)
    {
        $cities = City::where('state_id' , $state_id)->select('id','name')->get();

        return response()->json(['success' => true , 'data' => compact('cities')]);
    }

    public function sendParcel(Request $request)
    {
        request()->validate([
            'parcel_id' => 'required|integer',
            'weight'    => 'required|integer',
            'length'    => 'required|integer',
            'width'     => 'required|integer',
            'height'    => 'required|integer',
            'quantity'  => 'required|integer',
            'notes'    =>  'sometimes|string'
        ]);


        $getparcel = ParcelPackage::where('id' , $request->parcel_id)->first();

        if(is_null($getparcel))
        {
            return response()->json(['success' => false , 'message' => 'Please provide accurate parcel ID']);
        }

        //check weight calculation
        $weightAmount = Weight::where('min_weight', '<=', $request->weight)
                                ->where('max_weight', '>=', $request->weight)
                                ->first();
        if(is_null($weightAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your weight dimension is out of ranger , please contact support']);
        }

        //check height calculation
        $heightAmount = Height::where('min_height', '<=', $request->height)
            ->where('max_height', '>=', $request->height)
            ->first();

        if(is_null($heightAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your height dimension is out of ranger , please contact support']);
        }

        //check length calculation
        $lengthAmount = Length::where('min_length', '<=', $request->length)
            ->where('max_length', '>=', $request->length)
            ->first();

        if(is_null($lengthAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your length dimension is out of ranger , please contact support']);
        }

        //check length calculation
        $widthAmount = Width::where('min_width', '<=', $request->width)
            ->where('max_width', '>=', $request->width)
            ->first();

        if(is_null($widthAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your width dimension is out of ranger , please contact support']);
        }


        $amount =  (double) $widthAmount->amount +
                   (double) $lengthAmount->amount +
                   (double) $weightAmount->amount +
                   (double) $heightAmount->amount;

        $amountTotal = $amount * (int) $request->quantity;
        $parcel_id  = $request->parcel_id;
        $weight     = $request->weight;
        $height     = $request->height;
        $length     = $request->length;
        $width      = $request->width;
        $notes      = $request->notes;
        $quantity   = $request->quantity;



        return response()->json(['success' => true , 'data' => compact('amountTotal',
            'width', 'height','length','weight','parcel_id' , 'notes','quantity')]);
    }


    public function storeUserInfo(Request $request)
    {
        request()->validate([
            'parcel_id' => 'required|integer',
            'amountTotal' => 'required|integer',
            'weight'    => 'required|integer',
            'length'    => 'required|integer',
            'width'     => 'required|integer',
            'height'    => 'required|integer',
            'quantity'  => 'required|integer',
            'notes'    =>  'sometimes|string',
            'sender_name' => 'required|string',
            'sender_phone_number' => 'required|string',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'receiver_name' => 'required|string',
            'receiver_phone_number' => 'required|string',
            'delivery_state_id' => 'required|integer',
            'delivery_city_id' => 'required|integer',
        ]);


        //fetch pick up price
        $pickUpAmount = City::where('state_id' , $request->state_id)->where('id' , $request->city_id)->select('amount')->first();

        if(!$pickUpAmount)
        {
            return response()->json(['success' => false , 'message' => 'Oops!! City not found']);
        }
        $dropOffAmount = City::where('state_id' , $request->delivery_state_id)->where('id' , $request->delivery_city_id)->select('amount')->first();

        if(!$dropOffAmount)
        {
            return response()->json(['success' => false , 'message' => 'Oops!! City not found']);
        }
         $newTotalAmount = (double) $dropOffAmount->amount + (double)  $pickUpAmount->amount + (double) $request->amountTotal;

        DB::beginTransaction();
        $recordParcelInfo = new DeliveryParcel();
        $recordParcelInfo->user_id                 = auth()->user()->id;
        $recordParcelInfo->parcel_id               = $request->parcel_id;
        $recordParcelInfo->weight                  = $request->weight;
        $recordParcelInfo->height                  = $request->height;
        $recordParcelInfo->length                  = $request->length;
        $recordParcelInfo->width                   = $request->width;
        $recordParcelInfo->notes                   = $request->notes;
        $recordParcelInfo->quantity                = $request->quantity;
        $recordParcelInfo->amount                  = $newTotalAmount;
        $recordParcelInfo->sender_name             = $request->sender_name;
        $recordParcelInfo->sender_phone_number     = $request->sender_phone_number;
        $recordParcelInfo->state_id                = $request->state_id;
        $recordParcelInfo->city_id                 = $request->city_id;
        $recordParcelInfo->receiver_name           = $request->receiver_name;
        $recordParcelInfo->receiver_phone_number   = $request->receiver_phone_number;
        $recordParcelInfo->delivery_state_id       = $request->delivery_state_id;
        $recordParcelInfo->delivery_city_id        = $request->delivery_city_id;
        $recordParcelInfo->save();
        DB::commit();
        return response()->json(['success' => true , 'data' => compact('recordParcelInfo')]);
    }


    public function addCashPayment(Request $request)
    {
        request()->validate(['service_id' => 'required|integer' , 'amount' => 'required|integer' ,'delivery_parcel_id' => 'required|integer']);
        $findParcel = DeliveryParcel::where('id', $request->delivery_parcel_id)->firstorfail();
        $this->handlePayment($request->amount , $request->service_id , $findParcel);
        return response()->json(['success' => true , 'message' => 'Success !! cash payment made successfully']);


    }

    private function handlePayment($amount , $serviceId , $parcel)
    {
        DB::beginTransaction();
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = $reference;
        $transactions->amount = (double) $amount;
        $transactions->status = 'Pending';
        $transactions->description = 'Cash Payment';
        $transactions->user_id = auth()->user()->id;
        $transactions->service_id = $serviceId;
        $transactions->delivery_parcel_id = $parcel->id;
        $transactions->transaction_type  = 'cash payment';
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;

        $findParcel = DeliveryParcel::where('id', $parcel->id)->with('city','delivery_city')->firstorfail();

        $maildata = [
            'name' =>   $data['name'] ,
            'service' => 'Parcel delivery Service',
            'transaction' => $transactions,
            'reference' => $reference,
            'totalAmount' => $amount,
            'delivery_city' => $findParcel->delivery_city->name,
            'pickup_city' => $findParcel->city->name
        ];
        $email =  $data["email"];

        Mail::to($email)->send(new \App\Mail\Parcel($maildata));
        DB::commit();

    }

}
