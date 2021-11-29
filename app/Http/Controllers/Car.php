<?php

namespace App\Http\Controllers;


use App\Classes\Reference;
use App\Exports\CarsExport;
use App\Imports\CarsImport;
use App\Mail\CarHireRecept;
use App\Models\CarHistory;
use PDF;
use Illuminate\Http\Request;
use App\Models\Car as HiredCars;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CarPlan;
use App\Models\Transaction;




class Car extends Controller
{
    public function allCars()
    {
        $cars = HiredCars::all();

        return view('admin.cars.cars', compact('cars'));
    }

    public function addCars(Request $request)
    {


           $data  = request()->validate([
                            'car_type' => 'required',
                            'car_class' => 'required',
                            'daily_rentals' => 'required',
                            'extra_hour' => 'required',
                            'sw_fare' => 'required',
                            'ss_fare' => 'required',
                            'se_fare' => 'required',
                            'nc_fare' => 'required',
                            'description'=> 'required',
                            'capacity' => 'required'
                        ]);


               $service_id  = \App\Models\Service::where('id',6)
                                                            ->select('id')->first();

               $car                  = new HiredCars();
               $car->car_class       = $data['car_class'];
               $car->car_type        = $data['car_type'];
               $car->description     = $data['description'];
               $car->capacity        = $data['capacity'];
               $car->service_id      = $service_id->id;
               $car->save();

              $Dailyplan = new \App\Models\CarPlan();
              $Dailyplan->plan = 'Daily Rentals';
              $Dailyplan->amount = $data['daily_rentals'];
              $Dailyplan->extra_hour = $data['extra_hour'];
              $Dailyplan->car_id = $car->id;
              $Dailyplan->save();

              $SWPlan = new \App\Models\CarPlan();
              $SWPlan->plan = 'South West';
              $SWPlan->amount = $data['sw_fare'];
              $SWPlan->car_id = $car->id;
              $SWPlan->save();


              $SSPlan = new \App\Models\CarPlan();
              $SSPlan->plan = 'South South';
              $SSPlan->amount = $data['ss_fare'];
              $SSPlan->car_id = $car->id;
              $SSPlan->save();

              $SEPlan = new \App\Models\CarPlan();
              $SEPlan->plan = 'South East';
              $SEPlan->amount = $data['se_fare'];
              $SEPlan->car_id = $car->id;
              $SEPlan->save();

              $NCPlan = new \App\Models\CarPlan();
              $NCPlan->plan = 'North Central';
              $NCPlan->amount = $data['nc_fare'];
              $NCPlan->car_id = $car->id;
              $NCPlan->save();

             return   response()->json(['success' => 'true', 'message' => 'Data saved successfully']);

    }


    public function carList()
    {
        $cars = HiredCars::where('functional',1)->paginate(10);


        return view('pages.car-hire.hire', compact('cars'));
    }


    public function carHistory($car_id)
    {

        $carHistory = HiredCars::where('id',$car_id)->firstorfail();

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
        $car = HiredCars::where('id',$car_id)->with('plans')->first();


        return view('pages.car-hire.plan', compact('car'));
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
                    'time' => 'required'
                ]);

              //ensure user is unable to pick a date  that has already passed
              $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
              $currentTime = \Carbon\Carbon::now()->format('H:i');


              if( $data['date'] >= $currentDate  && $data['time'] >= $currentTime )
              {

                  $plan =  CarPlan::where('id' , $plan_id)->with('car')->firstorfail();
                  $service = \App\Models\Service::where('id' , $plan->car->service_id)->firstorfail();



                  //find if the car is already un-available
                  //check if the car wont be available on the day selected

                  //so check if the date selected does not match any date  already booked to be used
                  $findCarHistroryForThisDate = CarHistory::where('payment_status','!=','Unpaid')
                                                              ->where('date','=',$data['date'])
                                                              ->where('isConfirmed' ,'=','True')
                                                              ->first();


//dd($findCarHistroryForThisDate );

                IF(is_null($findCarHistroryForThisDate))
                {
                    $recordOperation                =  new CarHistory();
                    $recordOperation->car_id        =  $plan->car->id;
                    $recordOperation->car_plan_id   =  $plan->id;
                    $recordOperation->user_id       =  auth()->user()->id;
                    $recordOperation->date          =  $data['date'];
                    $recordOperation->time          =  $data['time'];
                    $recordOperation->save();

                    return view('pages.car-hire.payment',compact('recordOperation','plan','service'));
                }else{

                    toastr()->error('This car is not available for this period , please select another date ');
                    return back();
                }


              }else{
                  toastr()->error('You can\'t pick a date or time that has already passed');
                  return back();
              }

    }


    public function makePayment($history_id)
    {

       $carHistory         =  CarHistory::where('id', $history_id)->first();
       $fetchService_id    =  HiredCars::where('id', $carHistory->car_id)->select('service_id')->first();
       $checkServicePlan   =  CarPlan::where('id' , $carHistory->car_plan_id)->first();


       $carHistory->update(['payment_status' => 'cash payment','isConfirmed' => 'True']);

       $transaction                   =  new Transaction();
       $transaction->reference        =  Reference::generateTrnxRef();
       $transaction->amount           =  $checkServicePlan->amount;
       $transaction->status           = 'Cash payment';
       $transaction->service_id       =  $fetchService_id->service_id;
       $transaction->transaction_type = 'cash';
       $transaction->user_id          =  auth()->user()->id;
       $transaction->description      = 'A cash payment for made successfully';

       $transaction->save();


        $data["email"] = auth()->user()->email;
        $data["title"] = env('APP_NAME').' Car Hire Receipt';
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('pdf.car-hire', $data);

        Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "receipt.pdf");
        });


        toastr()->success('Cash Payment Made successfully');

        return redirect('/car-hire');
    }





}
