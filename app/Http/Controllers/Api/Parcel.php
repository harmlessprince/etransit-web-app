<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Height;
use App\Models\Length;
use App\Models\State;
use App\Models\Weight;
use App\Models\Width;
use Illuminate\Http\Request;
use App\Models\Parcel as ParcelPackage;

class Parcel extends Controller
{
    public function fetchParcel()
    {
        $parcels = ParcelPackage::all();

        $states = State::all();

        return response()->json(['success' => true , 'data' => compact('parcels','states')]);
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
        $lengthAmount = Length::where('min_length', '<=', $request->height)
            ->where('max_length', '>=', $request->height)
            ->first();

        if(is_null($lengthAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your length dimension is out of ranger , please contact support']);
        }

        //check length calculation
        $widthAmount = Width::where('min_width', '<=', $request->height)
            ->where('max_width', '>=', $request->height)
            ->first();

        if(is_null($widthAmount))
        {
            return response()->json(['success' => false , 'message' => 'Oops !!! your length dimension is out of ranger , please contact support']);
        }


        $amount = (double) $widthAmount->amount + (double) $lengthAmount->amount + (double) $weightAmount->amount + (double) $heightAmount->amount;

        $amountTotal = $amount * (int) $request->quantity;



        return response()->json(['success' => true , 'data' => compact('amountTotal')]);
    }
}
