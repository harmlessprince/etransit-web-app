<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Car as HiredCars;
use App\Models\CarClass;
use App\Models\CarHistory;
use App\Models\CarImage;
use App\Models\CarPlan;
use App\Models\CarType;
use App\Models\Transaction;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Destination;
use DataTables;
use DateTime;

class CarHireMgt extends Controller
{
    public function allCars()
    {
        $cars = HiredCars::all();
        $CountCars = HiredCars::count();
        //find transactions that belongs to this service which is car hire service
        $transactionSum = Transaction::where('tenant_id' , session()->get('tenant_id'))->where('service_id',6)->pluck('amount')->sum();
        return view('Eticket.car-hire.all-cars', compact('cars','CountCars', 'transactionSum'));
    }

    public function createCars()
    {

        $classes = CarClass::all();
        $types = CarType::all();
        $locations = Destination::all();

        return view('Eticket.car-hire.create-cars', compact('classes','types','locations'));
    }



    public function storeCar(Request $request)
    {


        $data  = request()->validate([
            'car_type' => 'required|integer',
            'car_class' => 'required|integer',
            'daily_rentals' => 'required',
            'extra_hour' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sw_region_fare' => 'sometimes',
            'ss_region_fare' => 'sometimes',
            'se_region_fare' => 'sometimes',
            'nc_region_fare' => 'sometimes',
            'description'=> 'required',
            'capacity' => 'required',
            'car_brand' => 'required',
            'car_registration' => 'required|unique:cars',
            'transmission' => 'required|string',
            'model_year' => 'required',
            'operating_state' => 'required|integer',
            'self_drive' => 'sometimes',
        ]);


        DB::beginTransaction();
        $service_id  = \App\Models\Service::where('id',6)->select('id')->first();

        $car                   = new HiredCars();
        $car->car_class_id     = $data['car_class'];
        $car->car_type_id      = $data['car_type'];
        $car->description      = $data['description'];
        $car->capacity         = $data['capacity'];
        $car->service_id       = $service_id->id;
        $car->tenant_id        = session()->get('tenant_id');
        $car->car_name         = $data['car_brand'];
        $car->car_registration = $data['car_registration'];
        $car->model_year       = $data['model_year'];
        $car->transmission     = $data['transmission'];
        $car->self_drive       = !is_null($request->self_drive) == "on" ? 'active' : 'inactive';
        $car->state_id         = $data['operating_state'];
        $car->save();

        if($request->hasfile('images'))
        {

            $input=$request->file('images');

            $images=array();
            if($files=$request->file('images')){

                foreach($files as  $file){
                    $request->validate([
                        'images' => 'required|array',
                        'images.*' => '|mimes:jpg,jpeg,png|max:2048',
                    ]);
//                           dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                    //|dimensions:max_width=232,max_height=83
                    $name=$file->getClientOriginalName();
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    $carImage = new CarImage();
                    $carImage->car_id = $car->id;
                    $carImage->path   = $uploadedFileUrl;
                    $carImage->save();
                }

            }
        }

        $Dailyplan = new \App\Models\CarPlan();
        $Dailyplan->plan       = 'Daily Rentals';
        $Dailyplan->amount     = $data['daily_rentals'];
        $Dailyplan->extra_hour = $data['extra_hour'];
        $Dailyplan->tenant_id  = $car->tenant_id;
        $Dailyplan->car_id     = $car->id;
        $Dailyplan->save();
        if(isset($data['sw_region_fare'])){
            $SWPlan = new \App\Models\CarPlan();
            $SWPlan->plan   = 'South West';
            $SWPlan->amount = $data['sw_region_fare'];
            $SWPlan->extra_hour = $data['extra_hour'];
            $SWPlan->tenant_id = $car->tenant_id;
            $SWPlan->car_id = $car->id;
            $SWPlan->save();
        }

        if(isset($data['ss_region_fare'])){
            $SSPlan = new \App\Models\CarPlan();
            $SSPlan->plan   = 'South South';
            $SSPlan->amount = $data['ss_region_fare'];
            $SSPlan->extra_hour = $data['extra_hour'];
            $SSPlan->tenant_id = $car->tenant_id;
            $SSPlan->car_id = $car->id;
            $SSPlan->save();
        }

        if(isset($data['se_region_fare'])){
            $SEPlan = new \App\Models\CarPlan();
            $SEPlan->plan   = 'South East';
            $SEPlan->amount = $data['se_region_fare'];
            $SEPlan->extra_hour = $data['extra_hour'];
            $SEPlan->tenant_id = $car->tenant_id;
            $SEPlan->car_id = $car->id;
            $SEPlan->save();
        }

        if(isset($data['nc_region_fare'])){
            $NCPlan = new \App\Models\CarPlan();
            $NCPlan->plan   = 'North Central';
            $NCPlan->amount = $data['nc_region_fare'];
            $NCPlan->extra_hour = $data['extra_hour'];
            $NCPlan->tenant_id = $car->tenant_id;
            $NCPlan->car_id = $car->id;
            $NCPlan->save();
        }





        DB::commit();
        Alert::success('Success ', 'Car added successfully');
        return  redirect('e-ticket/car-hire');
    }


    public function editCar($car_id)
    {
        $editCar = HiredCars::where('id', $car_id)->first();
        $classes = CarClass::all();
        $types = CarType::all();
        $locations = Destination::all();

        return view('Eticket.car-hire.edit-car', compact('locations','types','classes','editCar'));
    }

    public function updateCarInformation(Request $request , $car_id)
    {

        $data  = request()->validate([
            'car_type' => 'required|integer',
            'car_class' => 'required|integer',
            'description'=> 'required',
            'capacity' => 'required',
            'car_brand' => 'required',
            'car_registration' => 'required',
            'transmission' => 'required|string',
            'model_year' => 'required',
            'operating_state' => 'required|integer'
        ]);

        $updateCar = HiredCars::where('id', $car_id)->first();

        $updateCar->update([
            'car_name'         => $request['car_brand'],
            'car_class_id'     => $request['car_class'],
            'car_type_id'      => $request['car_type'],
            'description'      => $request['description'],
            'capacity'         => $request['capacity'],
            'car_registration' => $request['car_registration'],
            'model_year'       => $request['model_year'],
            'transmission'     => $request['transmission'],
            'state_id'         => $request['operating_state'],
            'self_drive'       => !is_null($request->self_drive) == "on" ? 'active' : 'inactive',
        ]);

        Alert::success('Success ', 'Car updated successfully');

        return  redirect('e-ticket/car-hire');
    }


    public function editCarPlan($car_id)
    {

        $carplans = CarPlan::where('car_id',$car_id)->get();
        $carId = $car_id;

        return view('Eticket.car-hire.car-plan', compact('carplans','carId'));
    }

    public function updateCarPlan(Request $request , $car_id)
    {

        $data  = request()->validate([
            'Daily_Rentals' => 'sometimes',
            'South_West'    => 'sometimes',
            'South_South'   => 'sometimes',
            'South_East'    => 'sometimes',
            'North_Central' => 'sometimes',
        ]);

        DB::beginTransaction();
        if(isset($data['sw_region_fare'])){
            $updateSWRental  = CarPlan::where('car_id',$car_id)->where('plan' ,'South West')->first();
            $updateSWRental->update(['amount' => $data['South_West']]);
        }

        if(isset($data['ss_region_fare'])){
            $updateSSRental  = CarPlan::where('car_id',$car_id)->where('plan' ,'South South')->first();
            $updateSSRental->update(['amount' => $data['South_South']]);
        }

        if(isset($data['se_region_fare'])){
            $updateSERental  = CarPlan::where('car_id',$car_id)->where('plan' ,'South East')->first();
            $updateSERental->update(['amount' => $data['South_East']]);
        }

        if(isset($data['nc_region_fare'])){
            $updateNCRental  = CarPlan::where('car_id',$car_id)->where('plan' ,'North Central')->first();
            $updateNCRental->update(['amount' => $data['North_Central']]);
        }
        $updateDailyRental  = CarPlan::where('car_id',$car_id)->where('plan' ,'Daily Rentals')->first();
        $updateDailyRental->update(['amount' => $data['Daily_Rentals']]);

        DB::commit();

        Alert::success('Success ', 'Car Plans updated successfully');

        return  redirect('e-ticket/car-hire');



    }


    public function viewCar(int $car_id)
    {

        $car = HiredCars::where('id', $car_id)->with('carclass','cartype')->first();

        $carHistories = CarHistory::where('car_id', $car_id)->pluck('id');

        //find transactions that belongs to this service which is car hire service
        $transactionSum = Transaction::where('tenant_id' , session()->get('tenant_id'))
                                     ->whereIn('car_history_id',$carHistories)->pluck('amount')->sum();

        $carPlans = CarPlan::where('car_id',$car_id)->get();

        $carHistories = CarHistory::where('car_id',$car_id)->count();

        return view('Eticket.car-hire.view-car' , compact('car','carPlans','carHistories', 'transactionSum'));
    }

    public function viewCarHistories($car_id)
    {
        $carHistories = CarHistory::where('payment_status','!=','Unpaid')->where('car_id',$car_id)->with('user','carplan')->orderBy('created_at','desc')->get();

        return view('Eticket.car-hire.view-car-histories',compact('carHistories'));
    }

    public function viewCarHistory($car_history_id)
    {
        $carHistory = CarHistory::where('id',$car_history_id)->with('user','carplan','car')->first();


        return view('Eticket.car-hire.view-car-history', compact('carHistory'));
    }

    public function confirmPickUp($car_history_id)
    {
        $carHistory = CarHistory::where('id', $car_history_id)->first();
        $carHistory->update([
            'available_status' => 'On Trip'
        ]);

        Alert::success('Success ', 'Pick Up confirmed successfully');
        return back();
    }

    public function  confirmDropOff($car_history_id)
    {
        $carHistory = CarHistory::where('id', $car_history_id)->first();

        //check the return rate and return time
        $carHistory->returnDate;
        $carHistory->returnTime;

        $timestamp =  Carbon::createFromDate($carHistory->returnDate, $carHistory->returnTime);
//
      $expectedReturnDate =  $timestamp->setDate($carHistory->returnDate->format('Y'),$carHistory->returnDate->format('m'),$carHistory->returnDate->format('d'))
                                           ->setTime($carHistory->returnTime->format('H'),$carHistory->returnTime->format('i'),$carHistory->returnTime->format('s'))->toDateTimeString();


      $returnDate = now()->toDateTimeString();



//        $diff = $returnDate -  $expectedReturnDate;
        if($expectedReturnDate < $returnDate && $carHistory->isReturned == 0 )
        {
            $normalDateToReturn = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $returnDate);
            $DateReturned = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $expectedReturnDate);

            $diff_in_hours = $DateReturned->diffInHours($normalDateToReturn);

            $ExtraHourBalance = $carHistory->carplan->extra_hour*$diff_in_hours;

            $carHistory->update([
                'amount_to_remit_after_delayed_trip' => $ExtraHourBalance,
                'numbers_of_hours_delayed' => $diff_in_hours,
                'dropOffDate'=> now()->format('Y-m-d'),
                'drpOffTime'=> now()->format('H:i:s'),
            ]);

            Alert::warning('Oops !!! ', 'Warning the expected return date / time already passed');
            return back();
        }

        $carHistory->update([
            'available_status' => 'Off Trip',
            'dropOffDate' => Carbon::now()->format('Y-m-d'),
            'dropOffTime' => Carbon::now()->format('h:i:s'),

        ]);

        Alert::success('Success ', 'Drop Off confirmed successfully');
        return back();
    }


    public function markAsPaid($car_history_id)
    {
        $carHistory = CarHistory::where('id', $car_history_id)->first();

        $carHistory->update([
            'isReturned' => 1,
        ]);

        Alert::success('Success ', 'You have successfully marked this car transaction as paid');
        return back();
    }

    public function fetchHiredCars(Request $request)
    {
        if ($request->ajax()) {
            $data = HiredCars::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-car/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-car/$id'  class='edit btn btn-danger btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function toggleUnAvailability($car_id)
    {
        $car = HiredCars::where('id',$car_id)->first();

        $car->update(['car_availability' => 1]);

        Alert::success('Success ', 'The action you performed is successful');
        return back();
    }

    public function toggleUnUnAvailability($car_id)
    {
        $car = HiredCars::where('id',$car_id)->first();

        $car->update(['car_availability' => 0]);

        Alert::success('Success ', 'The action you performed is successful');

        return back();
    }

    public function editCarImage($car_id)
    {
        $carPath = CarImage::where('car_id', $car_id)->get();
        $images = [];
        $ids = [];

        foreach($carPath as $img)
        {
            array_push($images , $img->path);
            array_push($ids , $img->id);
        }


        return view('Eticket.car-hire.edit-car-image', compact('car_id', 'images','ids'));
    }


    public function updateCarImage(Request $request , $car_id)
    {

        DB::beginTransaction();

        $images = array();

        if($files = $request->file('images')){

            foreach($files as $index =>  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $carImage = CarImage::where('id',$request->ids[$index])->firstorfail();
                $carImage->update([
                    'path'   =>  $uploadedFileUrl,
                ]);

            }

        }
        DB::commit();

        Alert::success('Success ', 'Car Image update was  successful');
        return back();
    }

}
