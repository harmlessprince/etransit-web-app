<?php

namespace App\Http\Controllers;

use App\Classes\Reference;
use App\Mail\TourPackages;
use App\Models\BoatTrip;
use App\Models\Service;
use App\Models\TourImage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Tour as TourPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class Tour extends Controller
{
    public function tourPackageList()
    {
//return request();
        $service = Service::where('id', 8)->firstorfail();
        $tours  = TourPackage::with('tourimages')->paginate(20);
        $tour_types = ['international', 'domestic'];

        if(!is_null(request()->tour_types) )
        {
            $tours  = TourPackage::with('tourimages')->whereIn('tour_type',request()->tour_types)->paginate(20);
        }

        if(!is_null(request()->tour_dates))
        {
            $tours  = TourPackage::with('tourimages')
                                    ->whereIn('tour_date',request()->tour_dates)
                                    ->paginate(20);
        }

        if(!is_null(request()->tour_dates) && !is_null(request()->tour_types) )
        {
            $tours  = TourPackage::with('tourimages')
                ->whereIn('tour_date',request()->tour_dates)
                ->whereIn('tour_type',request()->tour_types)
                ->paginate(20);

        }

        return view('pages.tour-packages.list', compact('service','tours','tour_types'));
    }

    public function filterTourSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = TourPackage::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }



    public function tourPackageShow($tour_id)
    {
        $service = Service::where('id', 8)->firstorfail();

        $tour  = TourPackage::where('id',$tour_id)->with('tourimages')->first();
        $tours  = TourPackage::with('tourimages')->paginate(20);
        $tour_types = ['international', 'domestic'];

        return view('pages.tour-packages.show', compact('service','tour','tours','tour_types'));
    }

    public function manageTour()
    {

        $tours = TourPackage::all();

        return view('admin.tour.index',compact('tours'));
    }


    public function addTour()
    {
        $service = Service::where('id', 8)->firstorfail();

        return view('admin.tour.store' , compact('service'));
    }

    public function storeTour(Request $request)
    {
        request()->validate([
            'tour_name'      => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'duration'       => 'required',
            'location'       =>'required',
            'amount_regular' => 'required',
            'amount_standard'  => 'required',
            'duration_options' => 'required',
            'description' => 'required',
            'tour_type' => 'required',
        ]);


        DB::beginTransaction();

        $tour = new TourPackage();
        $tour->name             = $request->tour_name;
        $tour->location         = $request->location;
        $tour->tour_date        = $request->departure_date;
        $tour->tour_time        = $request->departure_time;
        $tour->duration         = abs($request->duration);
        $tour->duration_options = $request->duration_options;
        $tour->service_id       = $request->service_id;
        $tour->amount_regular   = $request->amount_regular;
        $tour->amount_standard  = $request->amount_standard;
        $tour->description      = $request->description;
        $tour->tour_type        = $request->tour_type;
        $tour->save();

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
                $tourImage = new TourImage();
                $tourImage->tour_id = $tour->id;
                $tourImage->path = $uploadedFileUrl;
                $tourImage->save();
            }

        }
        DB::commit();

        Alert::success('Success ', 'Tour added successfully');

        return back();
    }

    public function history($tour_id)
    {
        $tourHistory = TourPackage::where('id' , $tour_id)->firstorfail();

        $transactions = \App\Models\Transaction::where('tour_id',$tour_id)->with('user')->simplePaginate(20);
//        dd($transactions);
        $transactionSum = \App\Models\Transaction::where('tour_id',$tour_id)->with('user')->pluck('amount')->sum();
        $transactionCount = \App\Models\Transaction::where('tour_id',$tour_id)->with('user')->count();

        return view('admin.tour.history' , compact('tourHistory','transactions','transactionSum','transactionCount'));

    }


    public function editTour($tour_id)
    {
        $tour = TourPackage::where('id', $tour_id)->with('tourimages')->firstorfail();

        return view('admin.tour.edit' , compact('tour'));
    }

    public function updateTour(Request $request , $tour_id)
    {
        request()->validate([
            'tour_name'      => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'duration'       => 'required',
            'location'       =>'required',
            'amount_regular' => 'required',
            'amount_standard'=> 'required'
        ]);

        DB::beginTransaction();

        $updateTour =   TourPackage::where('id', $tour_id)->firstorfail();

        $updateTour->update([
            'name'            => $request->tour_name,
            'description'     => $request->description,
            'location'        => $request->location,
            'duration'        => $request->duration,
            'tour_time'       => $request->departure_time,
            'tour_date'       => $request->departure_date,
            'amount_regular'  => $request->amount_regular,
            'amount_standard' => $request->amount_standard,
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
                $tourImage = TourImage::where('tour_id',$tour_id)->get();
                $tourImage[$index]->update([
                    'tour_id' => $tour_id,
                    'path'   => $uploadedFileUrl,
                ]);
            }
        }
        DB::commit();

        Alert::success('Success ', 'Updated  successfully');

        return back();
    }


    public function addPayment(Request $request , $tour_id , $service_id)
    {
        request()->validate([
            'amount' => 'required'
        ]);

        $tour = TourPackage::where('id',$tour_id)->first();
        $service = Service::where('id', 8)->firstorfail();

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

        return view('pages.tour-packages.payment', compact('amount','type','tour','service'));
    }

    public function addCashPaymentTour(Request $request)
    {

        request()->validate([
            'tour_id' => 'required|integer',
            'cruiseType' => 'required|string',
            'amount' => 'required',
            'service_id' => 'required'
        ]);

        $tour = TourPackage::where('id', $request->tour_id)->firstorfail();


        if(strtolower($request->cruiseType) == 'regular')
        {

            $this->handlePayment($request->amount , $request->service_id , $tour);

            toastr()->success('Success !! cash payment made successfully');
            return  redirect('/');
        }elseif(strtolower($request->cruiseType) == 'standard')
        {
            $this->handlePayment($request->amount , $request->service_id , $tour);
            toastr()->success('Success !! cash payment made successfully');
            return  redirect('/');
        }else{
            abort('404');
        }

    }

    private function handlePayment($amount , $serviceId , $trip)
    {
        DB::beginTransaction();
        $service = Service::where('id', 8)->firstorfail();
        $transactions = new \App\Models\Transaction();
        $transactions->reference = Reference::generateTrnxRef();
        $transactions->amount = (double) $amount;
        $transactions->status = 'Pending';
        $transactions->description = 'Cash Payment for '. $service->name . ' made on ' . now();
        $transactions->user_id = auth()->user()->id;
        $transactions->service_id = $serviceId;
        $transactions->transaction_type = 'cash payment';
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
