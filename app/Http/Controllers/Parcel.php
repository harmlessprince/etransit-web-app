<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\DeliveryParcel;
use App\Models\Height;
use App\Models\Length;
use App\Models\Service;
use App\Models\State;
use App\Models\Weight;
use App\Models\Width;
use Illuminate\Http\Request;
use App\Models\Parcel as ParcelPackage;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function editParcelCity($city_id)
    {
        $city = City::where('id' , $city_id)->with('state')->firstorfail();
        $states = State::all();

        return view('admin.parcel.edit' , compact('city','states'));
    }

    public function updateParcelCity(Request $request , $city_id)
    {
        request()->validate([
            'state' => 'required|integer',
            'city'  => 'required|string',
            'amount' => 'required'
        ]);

        $findCity = City::where('id' , $city_id)->firstorfail();

        $findCity->update([
          'state_id' => $request->state,
          'name'     => $request->city,
          'amount' => $request->amount
        ]);

        Alert::success('Success ', 'Updated successfully');

        return back();
    }


    public function parcelDeliveryRequest()
    {
        $deliveryParcelCount = DeliveryParcel::count();
        $deliveryParcelSum = DeliveryParcel::pluck('amount')->sum();

        $deliveries = DeliveryParcel::with('user','state','city','delivery_city','delivery_state')->simplePaginate(20);

        return view('admin.parcel.delivery-request', compact('deliveryParcelCount','deliveryParcelSum','deliveries'));
    }

    public function viewParcelDeliveryRequest($delivery_id)
    {
         $delivery = DeliveryParcel::where('id', $delivery_id)
                                    ->with('user','state','city','delivery_city','delivery_state','parcel')
                                    ->first();


        return view('admin.parcel.view-delivery-request', compact('delivery'));
    }
}
