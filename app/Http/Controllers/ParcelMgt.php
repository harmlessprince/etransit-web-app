<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use App\Models\City;
use App\Models\DeliveryParcel;
use App\Models\Height;
use App\Models\Length;
use App\Models\Parcel as ParcelPackage;
use App\Models\Service;
use App\Models\State;
use App\Models\Weight;
use App\Models\Width;
use App\Notifications\AdminOtherBookings;
use Illuminate\Http\Request;
use App\Models\Parcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use PDF;

class ParcelMgt extends Controller
{
    public function parcel()
    {
        $parcel = Parcel::limit(2)->get();
        $states = State::all();
        $cities = City::all();

        return view("pages.parcel.index" , compact('parcel','states','cities'));
    }

    public function fetchCities($state_id)
    {
        $cities = DB::table("cities")
            ->where("state_id",$state_id)
            ->select("id","name")->get();

        return json_encode($cities);
    }


    public function sendParcel(Request $request)
    {

          $attr =  request()->validate([
                            'document' => 'required',
                            'item_weight'    => 'required|integer',
                            'item_length'    => 'required|integer',
                            'item_width'     => 'required|integer',
                            'item_height'    => 'required|integer',
                            'item_quantity'  => 'required|integer',
                            'notes'    =>  'sometimes|string',
                            'senders_name' => 'required|string',
                            'senders_phone_number' => 'required|string',
                            'state' => 'required|integer',
                            'city' => 'required|integer',
                            'receiver_name' => 'required|string',
                            'receiver_phone_number' => 'required|string',
                            'delivery_state_id' => 'required|integer',
                            'delivery_city_id' => 'required|integer',
                            'receiver_landmark' => 'required|string',
                            'sender_landmark' => 'required|string'
                        ]);

        //check weight calculation
        $weightAmount = Weight::where('min_weight', '<=', $request->item_weight)
            ->where('max_weight', '>=', $request->item_weight)
            ->first();

        if(is_null($weightAmount))
        {
            toastr()->error('Oops !!! your weight dimension is out of ranger , please contact support');
            return back();
        }

        //check height calculation
        $heightAmount = Height::where('min_height', '<=', $request->item_height)
            ->where('max_height', '>=', $request->item_height)
            ->first();

        if(is_null($heightAmount))
        {
            toastr()->error('Oops !!! your height dimension is out of ranger , please contact support');
            return back();
        }

        //check length calculation
        $lengthAmount = Length::where('min_length', '<=', $request->item_length)
            ->where('max_length', '>=', $request->item_length)
            ->first();

        if(is_null($lengthAmount))
        {
            toastr()->error('Oops !!! your length dimension is out of ranger , please contact support');
            return back();
        }

        //check length calculation
        $widthAmount = Width::where('min_width', '<=', $request->item_width)
            ->where('max_width', '>=', $request->item_width)
            ->first();

        if(is_null($widthAmount))
        {
            toastr()->error('Oops !!! your width dimension is out of ranger , please contact support');
            return back();
        }

        $amount =  (double) $widthAmount->amount + (double) $lengthAmount->amount +
                   (double) $weightAmount->amount + (double) $heightAmount->amount;


        $amountTotal = $amount * (int) $request->item_quantity;
        $parcel_id  = $request->document;
        $weight     = $request->item_weight;
        $height     = $request->item_height;
        $length     = $request->item_length;
        $width      = $request->item_width;
        $notes      = $request->notes;
        $quantity   = $request->item_quantity;

        $data['weight']   = $weight;
        $data['height']   = $height ;
        $data['length']   =  $length ;
        $data['width']    = $width ;
        $data['notes']    = $notes;
        $data['quantity'] = $quantity;
        $data['parcel_id']= $parcel_id;

//        $request->session()->put('parcelData', $data);
//
//        //store all the parcel information in a session and use for later
//        $request->session()->put('parcelInfo', $attr);
        DB::beginTransaction();
        $recordParcelInfo = new DeliveryParcel();
        $recordParcelInfo->user_id                 = auth()->user()->id;
        $recordParcelInfo->parcel_id               = $parcel_id;
        $recordParcelInfo->weight                  = $weight;
        $recordParcelInfo->height                  = $height;
        $recordParcelInfo->length                  = $length;
        $recordParcelInfo->width                   = $width;
        $recordParcelInfo->notes                   = $notes;
        $recordParcelInfo->quantity                = $quantity;
        $recordParcelInfo->amount                  = $amountTotal;
        $recordParcelInfo->sender_name             = $request->senders_name;
        $recordParcelInfo->sender_phone_number     = $request->senders_phone_number;
        $recordParcelInfo->state_id                = $request->state;
        $recordParcelInfo->city_id                 = $request->city;
        $recordParcelInfo->receiver_name           = $request->receiver_name;
        $recordParcelInfo->receiver_phone_number   = $request->receiver_phone_number;
        $recordParcelInfo->delivery_state_id       = $request->delivery_state_id;
        $recordParcelInfo->delivery_city_id        = $request->delivery_city_id;
        $recordParcelInfo->receiver_landmark       =  $request->receiver_landmark;
        $recordParcelInfo->sender_landmark        =  $request->sender_landmark;
        $recordParcelInfo->save();
        DB::commit();
        $deliveryParcelId = $recordParcelInfo->id;

        return view('pages.parcel.payment', compact('amountTotal','deliveryParcelId'));
    }


    public function handleCashPayment(Request $request)
    {
        request()->validate(['delivery_parcel_id' => 'required', 'amount' => 'required']);

        //fetch service
        $service = Service::where('id',9)->firstorfail();


        $findParcel = DeliveryParcel::where('id', $request->delivery_parcel_id)->firstorfail();

        $this->handlePayment($request->amount , $service->id , $findParcel);

        toastr()->success('Success !! cash payment made successfully');

        return redirect('/');
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
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();

    }
}
