<?php

namespace App\Http\Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\RouteFare;
use App\Models\ScheduleRoute;
use App\Models\TrainClass;
use App\Models\TrainLocation;
use App\Models\TrainSchedule;
use App\Models\TrainSeatTracker;
use App\Models\TripType;
use Illuminate\Http\Request;
use App\Models\Train as TrainTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class Train extends Controller
{
    public function bookTrain()
    {
        $locations = TrainLocation::all();
        $tripType = TripType::all();
        $trainClass = TrainClass::all();

        return  response()->json(['success' => true , 'data' => compact('locations','tripType','trainClass')]);
    }


    public function checkSchedule(Request $request)
    {
       $attr = request()->validate([
                    'destination_from'  => 'required|integer',
                    'destination_to'    => 'required|integer',
                    'tripType'          => 'required|integer',
                    'passenger'         => 'required|integer',
                    'departure_date'    => 'required|date',
                    'return_date'       => 'sometimes|date'
                ]);


        (int)  $attr['tripType'] ==  1  ? $checkSchedule =  TrainSchedule::where('departure_date', $attr['departure_date'])
                                                ->where('pickup_id', $attr['destination_from'])
                                                ->where('destination_id',$attr['destination_to'])
                                                ->where('seats_available' , '>=', $attr['passenger'])
                                                ->with(['destination','pickup','train'])->get()

                                                : $checkSchedule =  TrainSchedule::where('departure_date',$attr['departure_date'])
                                                ->where('destination_id', $attr['destination_to'])
                                                ->where('seats_available' , '>=', $attr['passenger'])
                                                ->where('pickup_id',$attr['destination_from'])
                                                ->with(['destination','pickup','train'])->get();


        return response()->json(['success' => true ,'data' => compact('checkSchedule')]);
    }


    public function trainSeat($train_schedule_id , $train_id)
    {
        $trainSeats =  TrainSeatTracker::where('train_schedule_id', $train_schedule_id)
                            ->where('train_id',$train_id)->with(['trainseat' => function($query){
                                                 $query->with('trainclass')->get();
                              }])->get();

        return  response()->json(['success' => true , 'data' => compact('trainSeats',)]);
    }


    public function selectSeat(Request $request)
    {
        $attr = request()->validate([
                        'train_id' => 'required|integer',
                        'train_seat_id' => 'required|integer',
                        'train_schedule_id' => 'required|integer'
                    ]);


        $bookSeat = TrainSeatTracker::where('train_seat_id', $attr['train_seat_id'])
                                        ->where('train_id', $attr['train_id'])
                                        ->where('train_schedule_id', $attr['train_schedule_id'])
                                        ->firstorfail();

        $bookSeat->update([
            'user_id'=> auth()->user()->id,
            'booked_status' => 1,
        ]);



        return response()->json(['success'=> true , 'message' => 'Seat selected successfully']);
    }


    public function DeselectSeat(Request $request)
    {
        $attr = request()->validate([
            'train_id' => 'required|integer',
            'train_seat_id' => 'required|integer',
            'train_schedule_id' => 'required|integer'
        ]);


        $bookSeat = TrainSeatTracker::where('train_seat_id', $attr['train_seat_id'])
            ->where('train_id', $attr['train_id'])
            ->where('train_schedule_id', $attr['train_schedule_id'])
            ->firstorfail();

        $bookSeat->update([
            'user_id'=> null,
            'booked_status' => 0,
        ]);

        return response()->json(['success'=> true , 'message' => 'Seat deselected successfully']);
    }

    public function routeSelector($train_schedule_id)
    {
        $fetchRoutes = ScheduleRoute::where('train_schedule_id', $train_schedule_id)->with('trainRoutes')->get();

        return response()->json(['success' => true , 'data' => compact('fetchRoutes')]);
    }

    public function passengerDetails(Request $request)
    {
        request()->validate([
            'full_name'        => 'required|array',
            'gender'           => 'required|array',
            'passenger_option' => 'required|array',
            'schedule_id'      => 'required|integer',
            'route_id'         => 'required|array',
            'tripType'         => 'required|integer'
        ]);
        DB::beginTransaction();
        $passengerArray = [];
        $passengers = $request->full_name;

        foreach($passengers as $passenger)
        {
            if($passenger != null)
            {
                array_push($passengerArray ,$passenger);
            }
        }

        $passenger_options = $request['passenger_option'];
        $passengerOptionCount = count($passenger_options);
        $passengerCount = count($passengerArray);
        //find if the seats selected matches the number of passengers listed
        $selectedSeat = \App\Models\TrainSeatTracker::where('train_schedule_id',$request->schedule_id)
                                            ->where('user_id',auth()->user()->id)
                                            ->where('booked_status', 1)->with('trainseat')->get();


        if(!$selectedSeat)
        {
            abort('404');
        }


       $fetchScheduleDetails = \App\Models\TrainSchedule::where('id',$request->schedule_id)->with('train','destination','pickup')->first();

        if($passengerCount != count($selectedSeat))
        {

            foreach($selectedSeat as $unbookedseat)
            {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'user_id' => null
                ]);
            }

            return  response()->json(['success' => false , 'message' => 'Number of seats selected must match the passenger count' ]);
        }

        if($passengerCount != $passengerOptionCount)
        {

            foreach($selectedSeat as $unbookedseat)
            {
                $unbookedseat->update([
                    'booked_status' => 0,
                    'user_id' => null
                ]);
            }
            return  response()->json(['success' => false , 'message' => 'Please ensure the gender option is not more than the number of passenger intended for booking' ]);
        }else{

            $adult = [];
            $children = [];
            foreach($passenger_options as $passenger_option)
            {
                if(strtolower($passenger_option) == 'adult')
                {
                    array_push($adult , $passenger_option);
                }elseif (strtolower($passenger_option) == 'children')
                {
                    array_push($children , $passenger_option);
                }

            }
        }

        $adultCount = count($adult);
        $childrenCount = count($children);

        $totalFare = [];

        for($i = 0 ; $i < $passengerOptionCount ; $i++)
        {
            $createPassenger                        = new \App\Models\TrainPassenger();
            $createPassenger->full_name             = $request->full_name[$i];
            $createPassenger->gender                = $request->gender[$i];
            $createPassenger->passenger_age_range   = $request->passenger_option[$i];
            $createPassenger->train_schedule_id     = $request->schedule_id;
            $createPassenger->user_id               = auth()->user()->id;
            $createPassenger->train_seat_tracker_id = $selectedSeat[$i]->id;
            $createPassenger->save();

             //get each route id amount
             $tFare = RouteFare::where('train_stop_id' , $request->route_id[$i])->where('train_class_id',$selectedSeat[$i]->trainseat->class_id)->first();

             if(strtolower($request->passenger_option[$i]) == 'children')
             {
                 array_push($totalFare ,  $tFare->amount_child);
             }else{
                 array_push($totalFare ,  $tFare->amount_adult);
             }
        }

        $amount = array_sum($totalFare) * (int) $request->tripType;
        $ticketType = TripType::where('id', $request->tripType)->select('type')->firstorfail();
        $totalPasseneger = (int) $childrenCount + (int) $adultCount;
        DB::commit();


        return response()->json(['success' => true ,
           'data' => compact('childrenCount','fetchScheduleDetails','adultCount',
                'childrenCount','amount','selectedSeat','ticketType' , 'totalPasseneger') ]);
    }


    public function handleCashPayment(Request $request)
    {
        request()->validate([
            'amount'            => 'required',
            'service_id'        => 'required|integer',
            'train_schedule_id' => 'required|integer',
            'totalPasseneger'   => 'required|integer'
        ]);

        DB::beginTransaction();
        $transactions = new \App\Models\Transaction();
        $transactions->reference          = Reference::generateTrnxRef();
        $transactions->amount             = (double) $request->amount;
        $transactions->status             = 'Pending';
        $transactions->description        = 'Cash Payment';
        $transactions->user_id            = auth()->user()->id;
        $transactions->service_id         = $request->service_id;
        $transactions->train_schedule_id  = $request->train_schedule_id;
        $transactions->transaction_type   = "cash payment";
        $transactions->save();

        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;
        $data["title"] = env('APP_NAME').' Train Ticket Receipt';
        $data["body"]  = "This is Demo";

        $pdf = PDF::loadView('pdf.car-hire', $data);

        //find tain schedule and update the seat availability
        $seat = TrainSchedule::where('id', $request->train_schedule_id)->first();
        $availableSeats =  (int) $seat->seats_available - (int) $request->totalPasseneger;
        $seat->update([
            'seats_available' => $availableSeats
        ]);

        //fetch seat selected and book
        $checkSeatsTracking = TrainSeatTracker::where('train_schedule_id',$request->train_schedule_id)
                                                                 ->where('user_id', auth()->user()->id)
                                                                 ->where('booked_status' , 1)->get();

        foreach($checkSeatsTracking as $seatTracker)
        {
            $seatTracker->update([
                'booked_status' => 2
            ]);
        }

        Mail::send('pdf.car-hire', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "receipt.pdf");
        });
        DB::commit();

        return response()->json(['success' => true ,'message' => 'Cash Payment made successfully']);
    }
}
