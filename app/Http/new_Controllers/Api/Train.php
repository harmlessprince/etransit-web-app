<?php

namespace App\Http\new_Controllers\Api;

use App\Classes\Reference;
use App\Http\Controllers\Controller;
use App\Models\RouteFare;
use App\Models\ScheduleRoute;
use App\Models\TrainClass;
use App\Models\TrainLocation;
use App\Models\TrainSchedule;
use App\Models\TrainSeatTracker;
use App\Models\TripType;
use App\Notifications\AdminOtherBookings;
use Illuminate\Http\Request;
use App\Models\Train as TrainTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

        $returnDate = $request->return_date;

        return response()->json(['success' => true ,'data' => compact('checkSchedule','returnDate')]);
    }


    public function trainSeat($train_schedule_id , $train_id)
    {
        $trainSeats =  TrainSeatTracker::where('train_schedule_id', $train_schedule_id)
                            ->where('train_id',$train_id)->with(['trainseat' => function($query){
                                                 $query->with('trainclass')->get();
                              }])->get();




        $trainSeatObjectFirstClass = new \stdClass();
        $trainSeatObjectEconomyClass = new \stdClass();
        $trainSeatObjectBusinessClass = new \stdClass();

        foreach($trainSeats  as $index => $seat) {

            if($seat->trainseat->trainclass->class  == 'First Class')
            {
                $trainSeatObjectFirstClass->$index['id'] = $seat->id;
                $trainSeatObjectFirstClass->$index['coach_type'] = Ucfirst($seat->trainseat->coach_type) . Ucfirst($seat->trainseat->coach_number);
                $trainSeatObjectFirstClass->$index['class'] = 'First Class';
                $trainSeatObjectFirstClass->$index['booked_status'] = $seat->booked_status;


            }elseif($seat->trainseat->trainclass->class  == 'Business Class')
            {
                $trainSeatObjectBusinessClass->$index['id'] = $seat->id;
                $trainSeatObjectBusinessClass->$index['coach_type'] = Ucfirst($seat->trainseat->coach_type) . Ucfirst($seat->trainseat->coach_number);
                $trainSeatObjectBusinessClass->$index['class'] = 'Business Class';
                $trainSeatObjectBusinessClass->$index['booked_status'] = $seat->booked_status;

            }elseif($seat->trainseat->trainclass->class  == "Economy")
            {
                $trainSeatObjectEconomyClass->$index['id'] = $seat->id;
                $trainSeatObjectEconomyClass->$index['coach_type'] = Ucfirst($seat->trainseat->coach_type) . Ucfirst($seat->trainseat->coach_number);
                $trainSeatObjectEconomyClass->$index['class'] = 'Economy';
                $trainSeatObjectEconomyClass->$index['booked_status'] = $seat->booked_status;
            }


        }

        $trainSeatsPicker['first_class_seat'] = $trainSeatObjectFirstClass;
        $trainSeatsPicker['business_class_seat'] = $trainSeatObjectBusinessClass;
        $trainSeatsPicker['economy_class_seat'] = $trainSeatObjectEconomyClass;

        $schedule_id = $train_schedule_id;
        $tranId      = $train_id;
//        $trip_type  = $tripTypeId;

        $routeFare = RouteFare::with('terminal','destination_terminal','seatClass')->get();

        return  response()->json(['success' => true , 'data' => compact('trainSeats','trainSeatsPicker','schedule_id','routeFare','tranId')]);
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
        $fetchRoutes = ScheduleRoute::where('train_schedule_id', $train_schedule_id)->with(['routeFare' => function($query){
            $query->with('city', 'destination','terminal','destination_terminal','seatClass')->get();
        }])->get();
//        trainRoutes

        return response()->json(['success' => true , 'data' => compact('fetchRoutes')]);
    }

    public function passengerDetails(Request $request)
    {
    //     request()->validate([
    //         'full_name'        => 'required|array',
    //         'gender'           => 'required|array',
    //         'passenger_option' => 'required|array',
    //         'schedule_id'      => 'required|integer',
    //         'route_id'         => 'required|array',
    //         'tripType'         => 'required|integer',
    //         'next_of_kin_full_name' => 'required|array',
    //         'next_of_kin_phone_number' => 'required|array',
    //         'return_date' => 'sometimes'
    //     ]);
    //     DB::beginTransaction();
    //     $passengerArray = [];
    //     $passengers = $request->full_name;

    //     foreach($passengers as $passenger)
    //     {
    //         if($passenger != null)
    //         {
    //             array_push($passengerArray ,$passenger);
    //         }
    //     }

    //     $passenger_options = $request['passenger_option'];
    //     $passengerOptionCount = count($passenger_options);
    //     $passengerCount = count($passengerArray);
    //     //find if the seats selected matches the number of passengers listed
    //     $selectedSeat = \App\Models\TrainSeatTracker::where('train_schedule_id',$request->schedule_id)
    //                                         ->where('user_id',auth()->user()->id)
    //                                         ->where('booked_status', 1)->with('trainseat')->get();


    //     if(!$selectedSeat)
    //     {
    //         abort('404');
    //     }


    //   $fetchScheduleDetails = \App\Models\TrainSchedule::where('id',$request->schedule_id)->with('train','destination','pickup')->first();

    //     if($passengerCount != count($selectedSeat))
    //     {

    //         foreach($selectedSeat as $unbookedseat)
    //         {
    //             $unbookedseat->update([
    //                 'booked_status' => 0,
    //                 'user_id' => null
    //             ]);
    //         }

    //         return  response()->json(['success' => false , 'message' => 'Number of seats selected must match the passenger count' ]);
    //     }

    //     if($passengerCount != $passengerOptionCount)
    //     {

    //         foreach($selectedSeat as $unbookedseat)
    //         {
    //             $unbookedseat->update([
    //                 'booked_status' => 0,
    //                 'user_id' => null
    //             ]);
    //         }
    //         return  response()->json(['success' => false , 'message' => 'Please ensure the gender option is not more than the number of passenger intended for booking' ]);
    //     }else{

    //         $adult = [];
    //         $children = [];
    //         foreach($passenger_options as $passenger_option)
    //         {
    //             if(strtolower($passenger_option) == 'adult')
    //             {
    //                 array_push($adult , $passenger_option);
    //             }elseif (strtolower($passenger_option) == 'children')
    //             {
    //                 array_push($children , $passenger_option);
    //             }

    //         }
    //     }

    //     $adultCount = count($adult);
    //     $childrenCount = count($children);

    //     $totalFare = [];

    //     for($i = 0 ; $i < $passengerOptionCount ; $i++)
    //     {
    //         $createPassenger                        = new \App\Models\TrainPassenger();
    //         $createPassenger->full_name             = $request->full_name[$i];
    //         $createPassenger->gender                = $request->gender[$i];
    //         $createPassenger->passenger_age_range   = $request->passenger_option[$i];
    //         $createPassenger->train_schedule_id     = $request->schedule_id;
    //         $createPassenger->next_of_kin_full_name = $request->next_of_kin_full_name[$i];
    //         $createPassenger->next_of_kin_phone_number = $request->next_of_kin_phone_number[$i];
    //         $createPassenger->user_id               = auth()->user()->id;
    //         $createPassenger->train_seat_tracker_id = $selectedSeat[$i]->id;
    //         $createPassenger->save();

    //          //get each route id amount
    //          $tFare = RouteFare::where('train_stop_id' , $request->route_id[$i])->where('train_class_id',$selectedSeat[$i]->trainseat->class_id)->first();

    //          if(strtolower($request->passenger_option[$i]) == 'children')
    //          {
    //              array_push($totalFare ,  $tFare->amount_child);
    //          }else{
    //              array_push($totalFare ,  $tFare->amount_adult);
    //          }
    //     }

    //     $amount = array_sum($totalFare) * (int) $request->tripType;
    //     $ticketType = TripType::where('id', $request->tripType)->select('type')->firstorfail();
    //     $totalPasseneger = (int) $childrenCount + (int) $adultCount;
    //     $return_date = $request->return_date;
    //     DB::commit();

    request()->validate([
        'full_name'        => 'required|array',
        'gender'           => 'required|array',
        'passenger_option' => 'required|array',
        'schedule_id'      => 'required|integer',
        'route_id.*'       => 'integer',
        'route_id'         => 'required|array',
        'tripType'         => 'required|integer',
        'next_of_kin_full_name' => 'required|array',
        'next_of_kin_phone_number' => 'required|array',
        'return_date' => 'sometimes'
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
                                    ->where('booked_status', 1)->with('trainseat' , function($query){
                                        $query->with('trainclass')->get();
                                    })->get();


    if(!$selectedSeat)
    {

        foreach($selectedSeat as $unbookedseat)
        {
            $unbookedseat->update([
                'booked_status' => 0,
                'user_id' => null
            ]);
        }

        // toastr()->error('Error !! Ensure the number of seats selected matches the route picked');
        return  response()->json(['Error' => false , 'message' => 'Ensure the number of seats selected matches the route picked']);

        // return back();
    }

    //check if the class pick as route is the same class with the seat picked

    //first check if the number of seat selected is more than the route fare Ids;
    if(count($selectedSeat) != count($request->route_id))
    {

        foreach($selectedSeat as $unbookedseat)
        {

          $unbookedseat->update([
                'booked_status' => 0,
                'user_id' => null
            ]);

        }

        // toastr()->error('Error !! Ensure the number of seats selected matches the route picked');
        return  response()->json(['Error' => false , 'message' => 'Ensure the number of seats selected matches the route picked']);


        // return back();
    }


    $routeFare = RouteFare::whereIn('id' ,$request->route_id)->with('terminal','destination_terminal','seatClass')->get();
    //        dd($routeFare[0]->seatClass->class);

    $searchSeatTrackerClass = [];
    foreach($selectedSeat as $class)
    {
        array_push($searchSeatTrackerClass , $class->trainseat->trainclass->class);
    }

    $routeClass = [];

    foreach($routeFare as $routeClassName)
    {
        array_push($routeClass , $routeClassName->seatClass->class);
    }



    $containsSearchTicketClassForSeatAndRouteMatched = count(array_intersect($searchSeatTrackerClass, $routeClass)) === count($searchSeatTrackerClass);

    if(!$containsSearchTicketClassForSeatAndRouteMatched)
    {
        foreach($selectedSeat as $unbookedseat)
        {
            $unbookedseat->update([
                'booked_status' => 0,
                'user_id' => null
            ]);
        }




        return  response()->json(['Error' => false , 'message' => 'Ensure the seat class picked matched the route class selected']);
    }



    $fetchScheduleDetails = \App\Models\TrainSchedule::where('id',$request->schedule_id)
                                                    ->with('train','destination','pickup')->first();


    if($passengerCount != count($selectedSeat))
    {

        foreach($selectedSeat as $unbookedseat)
        {
            $unbookedseat->update([
                'booked_status' => 0,
                'user_id' => null
            ]);
        }

        return  response()->json(['Error' => false , 'message' => 'Number of seats selected must match the passenger count']);
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

        return  response()->json(['Error' => false , 'message' => 'Please ensure the gender option is not more than the number of passenger intended for booking']);
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
        $createPassenger                           = new \App\Models\TrainPassenger();
        $createPassenger->full_name                = $request->full_name[$i];
        $createPassenger->gender                   = $request->gender[$i];
        $createPassenger->passenger_age_range      = $request->passenger_option[$i];
        $createPassenger->train_schedule_id        = $request->schedule_id;
        $createPassenger->next_of_kin_full_name    = $request->next_of_kin_full_name[$i];
        $createPassenger->next_of_kin_phone_number = $request->next_of_kin_phone_number[$i];
        $createPassenger->user_id                  = auth()->user()->id;
        $createPassenger->train_seat_tracker_id    = $selectedSeat[$i]->id;
        $createPassenger->save();

        //get each route id amount
        $tFare = RouteFare::where('id' , $request->route_id[$i])
                            ->where('train_class_id',$selectedSeat[$i]->trainseat->class_id)->first();


        $childFareTotal = "";
        $adultFareTotal = "";
        if(strtolower($request->passenger_option[$i]) == 'children')
        {
            array_push($totalFare ,  $tFare->amount_child);
            $childFareTotal = $tFare->amount_child * $childrenCount;
        }else{
            array_push($totalFare ,  $tFare->amount_adult);
            $adultFareTotal = $tFare->amount_adult * $adultCount;
        }
    }

        $amount = array_sum($totalFare) * (int) $request->tripType;
        $ticketType = TripType::where('id', $request->tripType)->select('type')->firstorfail();
        $totalPasseneger = (int) $childrenCount + (int) $adultCount;

 //        $return_date = $request->return_date;

    if($request->has('setReturnDate'))
    {
        // $return_date = request()->session()->get('setReturnDate');
        $return_date = request()->returnDate;
    }else{
        $return_date = null;
    }

    $service = \App\Models\Service::where('id',2)->first();

    DB::commit();


        return response()->json(['success' => true ,
           'data' => compact('childrenCount','fetchScheduleDetails','adultCount','adultFareTotal',
             'childFareTotal',   'childrenCount','amount','selectedSeat','ticketType' , 'totalPasseneger','return_date') ]);
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
        $reference = Reference::generateTrnxRef();
        $transactions = new \App\Models\Transaction();
        $transactions->reference          = $reference;
        $transactions->amount             = (double) $request->amount;
        $transactions->status             = 'Pending';
        $transactions->description        = 'Cash Payment';
        $transactions->user_id            = auth()->user()->id;
        $transactions->service_id         = $request->service_id;
        $transactions->train_schedule_id  = $request->train_schedule_id;
        $transactions->transaction_type   = "cash payment";
        $transactions->save();





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


        $data["email"] =  auth()->user()->email;
        $data['name']  =  auth()->user()->full_name;



        $maildata = [
            'name' => auth()->user()->full_name,
            'service' => 'Train Booking',
            'transaction' => $transactions,
            'reference' =>  $reference,
            'departure_date' =>$seat->departure_date->format('Y-m-d'),
            'departure_time' => $seat->departure_time,
            'totalAmount' => $request->amount,
            'childrenCount' => request()->childrenCount,
            'adultCount' => request()->adultCount,
            'childFare' => request()->childrenFare,
            'adultFare' => request()->adultFare,
            'return_date' => request()->return_date
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new \App\Mail\TrainTicket($maildata));
        Notification::route('mail', env('ETRANSIT_ADMIN_EMAIL'))
            ->notify(new AdminOtherBookings($maildata));

        DB::commit();

        return response()->json(['success' => true ,'message' => 'Cash Payment made successfully']);
    }
}
