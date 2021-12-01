<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\Car as HiredCars;
use App\Models\CarClass;
use App\Models\CarHistory;
use App\Models\CarPlan;
use App\Models\CarType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use PDF;

class Car extends Controller
{
    public function CarType()
    {
      $types = CarType::all();

      return response()->json(['success' => true , 'data' => compact('types')]);

    }


    public function selectCarType($car_type_id)
    {
        $selectCarType = CarType::where('id', $car_type_id)->select('id')->first();

        if(!$selectCarType)
        {
            abort('404');
        }

        return response()->json(['success' => true ,'data' => compact('selectCarType')]);
    }


    public function carClass()
    {
        $carClass = CarClass::all();

        return response()->json(['success' => true , 'data' => compact('carClass')]);

    }

    public function selectCarClass($car_class_id , $selected_car_type_id)
    {
        $selectCarClass = CarClass::where('id', $car_class_id)->select('id')->first();

        if(!$selectCarClass)
        {
            abort('404');
        }


        return response()->json(['success' => true ,compact('selected_car_type_id','selectCarClass')]);
    }

    public function carList($selected_car_type_id , $selectCarClass)
    {

        $cars = HiredCars::where('functional',1)->where('car_type_id' , $selected_car_type_id)
                                        ->where('car_class_id',$selectCarClass)->paginate(20);

        return response()->json(['success' => true, compact('cars')]);
    }

    public function selectPlan($car_id)
    {
        $car = HiredCars::where('id',$car_id)->with('plans','cartype','carclass')->first();

        return response()->json(['success' =>true , compact('car')]);
    }


    public function pickPlan($plan_id)
    {
        $plan = CarPlan::where('id', $plan_id)->with('car')->first();

        return response()->json(['success' => true , compact('plan')]);
    }

    public function bookADate(Request $request ,$plan_id)
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

            $Carplan = $plan->plan;


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
                $bookingRecord                =  new CarHistory();
                $bookingRecord->car_id        =  $plan->car->id;
                $bookingRecord->car_plan_id   =  $plan->id;
                $bookingRecord->user_id       =  auth()->user()->id;
                $bookingRecord->date          =  $data['date'];
                $bookingRecord->time          =  $data['time'];
                $bookingRecord->returnTime    =  $returnTime ;
                $bookingRecord->returnDate    =  $returnDate;

                $bookingRecord->save();
                $bookingRecord->with('carplan','car')->first();

                return response()->json(['success' => true ,compact('bookingRecord','plan','service')]);
            }else{

                return response()->json(['success' => false , 'message' => 'This car is not available for this period , please select another date ']);
            }


        }else{

            return response()->json(['success' => false , 'message'=> 'You can\'t pick a date or time that has already passed' ]);
        }

    }


    public function makeCashPayment($history_id)
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
//       $transaction->car_plan_id      =  $carHistory->car_plan_id;
        $transaction->car_history_id   =  $history_id;
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

        return response()->json(['success' => true , 'message' => 'Cash Payment Made successfully ,if proof of fund is not confirmed within 30minutes this car will be available to other users to book']);
    }

}
