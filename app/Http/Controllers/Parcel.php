<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Height;
use App\Models\Length;
use App\Models\Service;
use App\Models\State;
use App\Models\Weight;
use App\Models\Width;
use Illuminate\Http\Request;
use App\Models\Parcel as ParcelPackage;

class Parcel extends Controller
{
    public function index()
    {
        $parcels = ParcelPackage::all();

        return view('admin.parcel.index', compact('parcels'));
    }

    public function store(Request $request)
    {
        request()->validate(['type' => 'required']);

        $service = Service::where('id',9)->firstorfail();

        $parcel = new ParcelPackage();
        $parcel->type = $request->type;
        $parcel->service_id = $service->id;
        $parcel->save();

        return response()->json(['success' => true , 'message' => 'Parcel type saved successfully']);
    }


    public function stateIndex()
    {
        $states = State::all();

        return view('admin.parcel.state' , compact('states'));
    }

    public function addState(Request $request)
    {
        request()->validate(['state' => 'required']);

        $state = new State();
        $state->name = $request->state;
        $state->save();
        return response()->json(['success' => true , 'message' => 'State  saved successfully']);
    }

    public function addCity()
    {


        $states = State::all();

        $cities = City::with('state')->get();

        return view('admin.parcel.city' , compact('states','cities'));
    }


    public function storeCity(Request $request)
    {
        request()->validate(['state_id' => 'required|integer' , 'city' => 'required|string' , 'amount' => 'required']);

        $city = new City();
        $city->state_id = $request->state_id;
        $city->name     = $request->city;
        $city->amount   = $request->amount;
        $city->save();

        return response()->json(['success' => true , 'message' => 'City saved successfully']);
    }

    public function manageHeight()
    {
        $heights = Height::all();

        return view('admin.parcel.height' , compact('heights',));
    }

    public function manageWeight()
    {
        $weights = Weight::all();

        return view('admin.parcel.weight' , compact('weights',));

    }

    public function manageLength()
    {
        $lengths = Length::all();

        return view('admin.parcel.length' , compact('lengths',));

    }

    public function manageWidth()
    {
        $widths = Width::all();

        return view('admin.parcel.width' , compact('widths',));
    }

    public function storeDimension(Request $request , $slug)
    {
        request()->validate(['min' => 'required|integer' , 'max' => 'required|integer' , 'amount' => 'required|integer']);

        switch($slug) {
            case 'height':
                   $this->height($request);
                    return response()->json(['success' => true , 'message' => 'height Dimension saved successfully']);
                break;
            case 'length':
                $this->length($request);
                return response()->json(['success' => true , 'message' => 'Length Dimension saved successfully']);
                break;
            case 'weight':
                $this->weight($request);
                return response()->json(['success' => true , 'message' => 'Weight Dimension saved successfully']);
                break;
            case 'width':
                $this->width($request);
                return response()->json(['success' => true , 'message' => 'Weight Dimension saved successfully']);
                break;
            default:
               break;
        }
    }

    private function height($data)
    {
        $height = new Height();
        $height->min_height = $data->min;
        $height->max_height = $data->max;
        $height->amount     = $data->amount;
        $height->save();
    }


    private function length($data)
    {
        $length = new Length();
        $length->min_length = $data->min;
        $length->max_length = $data->max;
        $length->amount     = $data->amount;
        $length->save();
    }

    private function weight($data)
    {
        $weight = new Weight();
        $weight->min_weight = $data->min;
        $weight->max_weight = $data->max;
        $weight->amount     = $data->amount;
        $weight->save();
    }

    private function width($data)
    {
        $width = new Width();
        $width->min_width = $data->min;
        $width->max_width = $data->max;
        $width->amount     = $data->amount;
        $width->save();
    }
}
