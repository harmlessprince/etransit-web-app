<?php

namespace App\Http\Controllers;


use App\Classes\Reference;
use App\Exports\CarsExport;
use App\Imports\CarsImport;
use App\Mail\BoatCruiseBooking;
use App\Mail\CarHire;
use App\Mail\CarHireRecept;
use App\Models\CarClass;
use App\Models\CarHistory;
use App\Models\CarImage;
use App\Models\CarType;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;
use App\Models\Car as HiredCars;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CarPlan;
use App\Models\Transaction;
use DateTime;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;


class Car extends Controller
{
    public function allCars()
    {

//        $cars  = HiredCars::withoutGlobalScopes()->orderby('id','desc')->with('carclass','cartype')->get();
        $offTripCount = CarHistory::where('available_status', 'Off Trip')->count();
        $onTripCount = CarHistory::where('available_status', 'On Trip')->count();
        $transactions = Transaction::where('service_id',6)->pluck('amount')->sum();

        return view('admin.cars.cars', compact('onTripCount','offTripCount','transactions'));
    }

    public function offTripCars()
    {
        return view('admin.cars.off-trip');
    }

    public function onTripCars()
    {
        return view('admin.cars.on-trip');
    }

    public function fetchAllOffTripCars(Request $request)
    {
        if ($request->ajax()) {
            $data = CarHistory::where('available_status','=', 'Off Trip')->with('car')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/$id'  class='edit btn btn-success btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function fetchAllTenantCars(Request $request)
    {
        if ($request->ajax()) {
            $data = HiredCars::withoutGlobalScopes()->orderby('id','desc')->with('carclass','cartype')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view/car/$id'  class='edit btn btn-success btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function viewTenantCar($id)
    {
        $car = HiredCars::withoutGlobalScopes()->where('id',$id)->with('carclass','cartype','tenant','carHistory','plans')->first();
//dd($car);
        return view('admin.cars.single-car',compact('car'));
    }

    public function carClass()
    {

        $carsClasses = CarClass::all();

       return view('admin.cars.car-class', compact('carsClasses'));
    }

    public function  saveCarClass(Request $request)
    {
        request()->validate([
            'car_class'=> 'required'
        ]);


        $carClass = new CarClass();
        $carClass->name = $request['car_class'];
        $carClass->save();

        return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);
    }

    public function carType()
    {

        $carsTypes = CarType::all();

        return view('admin.cars.car-type', compact('carsTypes'));
    }


    public function saveCarType(Request $request)
    {
        request()->validate([
            'car_type'=> 'required'
        ]);


        $carType = new CarType();
        $carType->name = $request['car_type'];
        $carType->save();

        return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);
    }

    public function addCar()
    {

        $classes  = CarClass::all();
        $types    = CarType::all();
        return view('admin.cars.store',compact('types','classes'));
    }


    public function storeCar(Request $request)
    {


           $data  = request()->validate([
                            'car_type' => 'required|integer',
                            'car_class' => 'required|integer',
                            'daily_rentals' => 'required',
                            'extra_hour' => 'required',
                            'sw_region_fare' => 'required',
                            'ss_region_fare' => 'required',
                            'se_region_fare' => 'required',
                            'nc_region_fare' => 'required',
                            'description'=> 'required',
                            'capacity' => 'required',
                            'car_brand' => 'required',
                            'car_registration' => 'required|unique:cars',
                            'transmission' => 'required|string',
                            'model_year' => 'required'
                        ]);


        DB::beginTransaction();
               $service_id  = \App\Models\Service::where('id',6)->select('id')->first();

               $car                   = new HiredCars();
               $car->car_class_id     = $data['car_class'];
               $car->car_type_id      = $data['car_type'];
               $car->description      = $data['description'];
               $car->capacity         = $data['capacity'];
               $car->service_id       = $service_id->id;
               $car->car_name         = $data['car_brand'];
               $car->car_registration = $data['car_registration'];
               $car->model_year       = $data['model_year'];
               $car->transmission     = $data['transmission'];
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
                           $carImage->path = $uploadedFileUrl;
                           $carImage->save();
                       }

                   }
               }

              $Dailyplan = new \App\Models\CarPlan();
              $Dailyplan->plan = 'Daily Rentals';
              $Dailyplan->amount = $data['daily_rentals'];
              $Dailyplan->extra_hour = $data['extra_hour'];
              $Dailyplan->car_id = $car->id;
              $Dailyplan->save();

              $SWPlan = new \App\Models\CarPlan();
              $SWPlan->plan = 'South West';
              $SWPlan->amount = $data['sw_region_fare'];
              $SWPlan->car_id = $car->id;
              $SWPlan->save();

              $SSPlan = new \App\Models\CarPlan();
              $SSPlan->plan = 'South South';
              $SSPlan->amount = $data['ss_region_fare'];
              $SSPlan->car_id = $car->id;
              $SSPlan->save();

              $SEPlan = new \App\Models\CarPlan();
              $SEPlan->plan = 'South East';
              $SEPlan->amount = $data['se_region_fare'];
              $SEPlan->car_id = $car->id;
              $SEPlan->save();

              $NCPlan = new \App\Models\CarPlan();
              $NCPlan->plan = 'North Central';
              $NCPlan->amount = $data['nc_region_fare'];
              $NCPlan->car_id = $car->id;
              $NCPlan->save();
        DB::commit();

        Alert::success('Success ', 'Car added successfully');

        return  back();

    }


    public function carList($seat_capacity= null , $class_type = null)
    {
        $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                         ->where('car_availability',1)
                         ->with('car_images','carclass','cartype','plans')
                         ->paginate(20);


        if(!is_null(request()->car_types) )
        {

            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->whereIn('car_type_id',request()->car_types)
                ->with('car_images','carclass','cartype','plans')
                ->paginate(20);
        }


        if(!is_null(request()->transmissions) )
        {

            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->whereIn('transmission',request()->transmissions)
                ->with('car_images','carclass','cartype','plans')
                ->paginate(20);
        }

        if(!is_null(request()->transmissions) && !is_null(request()->car_types) )
        {

            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->whereIn('transmission',request()->transmissions)
                ->whereIn('car_type_id',request()->car_types)
                ->with('car_images','carclass','cartype','plans')
                ->paginate(20);
        }

        if(!is_null(request()->locations) )
        {

            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->whereIn('state_id',request()->locations)
                ->with('car_images','carclass','cartype','plans' ,'tenant')
                ->paginate(20);

        }

        if(!is_null(request()->seat_capacity) )
        {

            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->where('capacity',request()->seat_capacity)
                ->with('car_images','carclass','cartype','plans' ,'tenant')
                ->paginate(20);

        }

        if(!is_null(request()->class_class))
        {
            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->where('car_class_id',request()->class_class)
                ->with('car_images','carclass','cartype','plans' ,'tenant')
                ->paginate(20);
        }

        if(!is_null(request()->class_type))
        {
            $cars = HiredCars::withoutGlobalScopes()->where('functional',1)
                ->where('car_availability',1)
                ->where('car_type_id',request()->class_type)
                ->with('car_images','carclass','cartype','plans' ,'tenant')
                ->paginate(20);
        }


        $catType = CarType::limit(10)->get();
        $transmission = ['automatic' , 'manual'];
        $states = \App\Models\Destination::inRandomOrder()->limit(10)->get();
        $carClasses =  CarClass::all();
        $carTypes = CarType::all();

        return view('pages.car-hire.hire', compact('cars','catType','transmission','states','carClasses','carTypes'));
    }


    public function carHistory($car_id)
    {

        $carHistory = HiredCars::where('id',$car_id)->with('car_images')->firstorfail();

        $histories = CarHistory::where('car_id',$car_id)->with('carplan','user')->orderby('created_at','desc')->get();


        return view('admin.cars.history', compact('carHistory','histories'));
    }

    public function importExportViewCars()
    {
        return view('admin.cars.import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportCar()
    {
        $cars = HiredCars::select('id','car_type','car_class','daily_rentals'
                                ,'extra_hour','sw_fare','ss_fare','se_fare','nc_fare','description','capacity' )->get();

        return Excel::download(new CarsExport($cars), 'cars.xlsx');

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importCars(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new CarsImport,request()->file('excel_file'));

        toastr()->success('Data saved successfully');

        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function selectPlan($car_id)
    {

        $car = HiredCars::where('id',$car_id)->with('plans','cartype','carclass')->first();

        return view('pages.car-hire.plan', compact('car'));
    }

    public function carDetails($car_id)
    {
        $car = HiredCars::where('id',$car_id)->with('plans','cartype','carclass','car_images')->first();
//dd($car);
        return view('pages.car-hire.details', compact('car'));
    }


    public function pickPlan($plan_id)
    {

         $findPaymentOption = CarPlan::where('id', $plan_id)->with('car')->first();

        return view('pages.car-hire.pick-up-date',compact('findPaymentOption'));
    }


    public function proceedToPaymentPlan(Request $request ,$plan_id)
    {
              $data =  request()->validate([
                    'date' => 'required',
                    'time' => 'required',
                    'days' => 'required',
                    'pickup_address' => 'required',
                    'self_drive' => 'sometimes'
                ]);


              //ensure user is unable to pick a date  that has already passed
              $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
              $currentTime = \Carbon\Carbon::now()->format('H:i');



              if( $data['date'] >= $currentDate)
              {


                  if( $data['date'] <= $currentDate && $data['time'] < $currentTime)
                  {
                      toastr()->error('You can\'t pick a time that has already passed');
                      return back();
                  }
                  $plan =  CarPlan::where('id' , $plan_id)->with('car')->firstorfail();
                  $service = \App\Models\Service::where('id' , $plan->car->service_id)->firstorfail();



                  //find if the car is already un-available
                  //check if the car wont be available on the day selected

                  //so check if the date selected does not match any date  already booked to be used
                  $findCarHistroryForThisDate = CarHistory::where('payment_status','!=','Unpaid')
                                                             ->where('car_id',$plan->car_id)
                                                              ->where('date','=',$data['date'])
                                                              ->where('isConfirmed' ,'=','True')
                                                              ->first();

                  $Carplan = $plan->plan ;


                  switch ($Carplan) {
                      case  'Daily Rentals':
                          $delayedTime =  Carbon::createFromFormat('H', env('DAILY_RENTALS'))->format('H:i:s');
                          break;
                      case 'North Central';
                          $delayedTime =  Carbon::createFromFormat('H', env('NC_RENTALS'))->format('H:i:s');
                          break;
                      case 'South West':
                          $delayedTime =  Carbon::createFromFormat('H', env('SW_RENTALS'))->format('H:i:s');
                          break;
                      case 'South South':
                          $delayedTime =  Carbon::createFromFormat('H', env('SS_RENTALS'))->format('H:i:s');
                          break;
                      case 'South East':
                          $delayedTime =  Carbon::createFromFormat('H', env('SE_RENTALS'))->format('H:i:s');
                          break;
                      default:
                          break;
                  }

                  ( $currentTime > 12) ? $daysToAdd = 1 :  $daysToAdd = 0;


                  $time = $data['time'];
                  $time2 = $delayedTime;

                  $secs = strtotime($time2)-strtotime("00:00:00");
                  $returnTime = date("H:i:s",strtotime($time)+$secs);

                  //add days if the rent time is 12pm and above to get the accurate date of returning
                  $date = Carbon::createFromFormat('Y-m-d', $data['date']);
                  $returnDate = $date->addDays($daysToAdd);



                IF(is_null($findCarHistroryForThisDate))
                {
                    $recordOperation                =  new CarHistory();
                    $recordOperation->car_id        =  $plan->car->id;
                    $recordOperation->car_plan_id   =  $plan->id;
                    $recordOperation->user_id       =  auth()->user()->id;
                    $recordOperation->date          =  $data['date'];
                    $recordOperation->time          =  $data['time'];
                    $recordOperation->days          =  abs($data['days']);
                    $recordOperation->pickup_address = $data['pickup_address'];
                    $recordOperation->returnTime    =  $returnTime ;
                    $recordOperation->returnDate    =  $returnDate;
                    $recordOperation->self_drive    =  $data['self_drive'] == "on" ? 'active' : 'inactive';
                    $recordOperation->save();
                    $recordOperation->with('carplan','car')->first();

                    return view('pages.car-hire.payment',compact('recordOperation','plan','service'));
                }else{

                    toastr()->error('This car is not available for this period , please select another date ');
                    return back();
                }


              }else{
                  toastr()->error('You can\'t pick a date  that has already passed');
                  return back();
              }

    }


    public function makePayment($history_id)
    {

       $carHistory         =  CarHistory::where('id', $history_id)->first();
       $fetchService_id    =  HiredCars::where('id', $carHistory->car_id)->select('service_id')->first();
       $checkServicePlan   =  CarPlan::where('id' , $carHistory->car_plan_id)->first();


       //update status to confirm so u wont allow other user to book the same date to avoid class
        //a cron job will be set to check payment confirmation from admin
        //after an hour the status will set to pending  and the booking date will be available to other
        // users if payment is not confirmed  within an hour

       $carHistory->update(['payment_status' => 'cash payment','isConfirmed' => 'True']);

       $transaction                   =  new Transaction();
       $transaction->reference        =  Reference::generateTrnxRef();
       $transaction->amount           =  $checkServicePlan->amount;
       $transaction->status           = 'Pending';
       $transaction->service_id       =  $fetchService_id->service_id;
       $transaction->transaction_type = 'cash payment';
       $transaction->user_id          =  auth()->user()->id;
       $transaction->tenant_id        =  $carHistory->car->tenant_id;
//       $transaction->car_plan_id   =  $carHistory->car_plan_id;
       $transaction->car_history_id   =  $history_id;
       $transaction->description      = 'A cash payment for made successfully';

       $transaction->save();

        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Car Hire',
            'transaction' => $transaction
        ];

        $email = auth()->user()->email;

        Mail::to($email)->send(new CarHire($maildata));

        toastr()->success('Cash Payment Made successfully');

        return redirect('/car-hire');
    }


    public function onTrip()
    {

        $carsOnTripCurrently = CarHistory::where('available_status','On Trip')
                                                ->with('car','carplan','user')
                                                ->orderby('returnDate','desc')->get();

        return view('admin.cars.on-trip', compact('carsOnTripCurrently'));
    }


    public function tripDetails($carhistory_id)
    {

        $car = CarHistory::where('id', $carhistory_id)->with('user','carplan','car')->first();

        return view('admin.cars.details',compact('car'));
    }

}
