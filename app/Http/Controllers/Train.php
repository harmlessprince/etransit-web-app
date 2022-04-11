<?php

namespace App\Http\Controllers;


use App\Classes\Reference;
use App\Models\RouteFare;
use App\Models\ScheduleRoute;
use App\Models\Service;
use App\Models\TrainClass;
use App\Models\TrainLocation;
use App\Models\TrainSchedule;
use App\Models\TrainSeat;
use App\Models\TrainSeatTracker;
use App\Models\TrainStop;
use App\Models\TripType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Train as TrainTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Train extends Controller
{
    public function index()
    {
        $trains = TrainTicket::all();

        return view('admin.train.index',compact('trains'));
    }

    public function create()
    {
        $trainClass = TrainClass::all();
        return view('admin.train.create', compact('trainClass'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $service = Service::where('id', 2)->firstorfail();

        $train                  = new TrainTicket();
        $train->name            = $request->train_name;
        $train->occupants       = $request->seats;
        $train->service_id      = $service->id;
        $train->save();

        $coachTypeCount = count($request->coach_type);
        $coachSeatCount = count($request->coach_seats);

        if($coachTypeCount != $coachSeatCount)
        {
            Alert::error('Warning ', 'Please ensure each coach has seat allocated to them');
            return back();
        }

        $CoachAllocatedSeat =array_sum($request->coach_seats);

        if($CoachAllocatedSeat != $request->seats)
        {
            Alert::error('Oops !!!', 'Seems your Train seat is less or more than number of seats allocated to each coach');
            return back();
        }

        foreach($request->coach_type as $index => $seat)
        {
            $coachType       = $request->coach_type[$index];
            $numberOfSeats   = $request->coach_seats[$index];
            $coachClass      = $request->train_class[$index];

            for($i = 0 ; $i < (int) $numberOfSeats; $i++ )
            {
                $trainSeatTracker               = new TrainSeat();
                $trainSeatTracker->train_id     = $train->id;
                $trainSeatTracker->coach_type   = $coachType;
                $trainSeatTracker->class_id     = $coachClass;
                $trainSeatTracker->coach_number =  $i+1;
                $trainSeatTracker->save();
            }

        }

        DB::commit();

        Alert::success('Success', 'Ferry Added Successfully');

        return back();

    }

    public function trainClassList()
    {
        $trainClass = TrainClass::all();
        return view('admin.train.class', compact('trainClass'));
    }


    public function storeTrainClass(Request $request)
    {
        request()->validate(['train_class' => 'required|string']);

        $trainClass = new TrainClass();
        $trainClass->class = $request->train_class;
        $trainClass->save();

        Alert::success('Success', 'Train Class Added Successfully');
        return back();

    }


    public function trainLocation()
    {
        $locations = TrainLocation::all();
        $trainClass = TrainClass::all();
        $eachstop   = TrainStop::with('state','class')->get();

        return view('admin.train.location' , compact('locations','trainClass','eachstop'));
    }


    public function storeTrainState(Request $request)
    {
        request()->validate(['train_state' => 'required|string']);

        $trainLocation = new TrainLocation;
        $trainLocation->locations_state = $request->train_state;
        $trainLocation->save();
        Alert::success('Success', 'State Added Successfully');
        return back();
    }

    public function addEachStop(Request $request)
    {
     $attr =  request()->validate([
                    'state' => 'required|integer' ,
                    'train_stop' => 'required|string'
//                    'amount_adult' => 'required' ,
//                    'amount_child' => 'required' ,
//                    'class_id' => 'required|integer'
                    ]);

     DB::beginTransaction();
          $trainStop = new TrainStop;
          $trainStop->train_location_id = $attr['state'];
          $trainStop->stop_name         = $attr['train_stop'];
          $trainStop->save();
      DB::commit();

      Alert::success('Success', 'Train Stop  Added Successfully');

      return back();
    }

    public function manageRoute()
    {
        $locations = TrainLocation::all();
        $routes = RouteFare::with('city','terminal','seatClass')->get();
        $trainClass = TrainClass::all();
        $trainRoutes = TrainStop::all();

        return view('admin.train.route' , compact('locations','trainRoutes','routes','trainClass'));
    }

    public function manageSchedule($train_id)
    {
        $train = TrainTicket::where('id' , $train_id)->firstorfail();
        $locations = TrainLocation::all();
        $trainRoutes = TrainStop::all();
        $routeFare = RouteFare::with('terminal','destination_terminal','seatClass')->get();

        return view('admin.train.schedule', compact('train','trainRoutes','locations' ,'routeFare'));
    }

    public function ScheduleTrainTrip(Request $request)
    {
                $attr = request()->validate([
                           'pickup' => 'required|integer',
                           'destination' => 'required|integer',
                           'date' => 'required',
                           'time' => 'required',
                           'route' => 'required|array'
                         ]);


                DB::beginTransaction();
                     $train = TrainTicket::where('id' , $request->train_id)->firstorfail();
                     $schedule = new TrainSchedule();
                     $schedule->train_id = $train->id;
                     $schedule->departure_time = $attr['time'];
                     $schedule->departure_date = $attr['date'];
                     $schedule->destination_id = $attr['destination'];
                     $schedule->pickup_id      = $attr['pickup'];
                     $schedule->how_many_stops = count($request->route);
                     $schedule->seats_available = $train->occupants;
                     $schedule->save();


                     if($schedule)
                     {
                         $trainSeat = TrainSeat::where('train_id', $train->id)->get();
                         foreach($trainSeat as $index =>  $seat)
                         {
                             $seatTracker = new TrainSeatTracker;
                             $seatTracker->train_seat_id       = $seat->id;
                             $seatTracker->train_id            = $train->id;
                             $seatTracker->train_schedule_id   = $schedule->id;
                             $seatTracker->save();
                         }
                     }

                     $routeArray = $request->route;

                     foreach($routeArray as $index => $route)
                     {
                         $routeTracker = new ScheduleRoute;
                         $routeTracker->train_schedule_id = $schedule->id;
//                         $routeTracker->train_stop_id     = $route;
                         $routeTracker->route_fare_id     = $route;
                         $routeTracker->save();
                     }

                 DB::commit();

                 Alert::success('Success', 'Train Schedule  Added Successfully');

                return back();
    }

    public function storeRoute(request $request)
    {
        $attr =  request()->validate([
            'state' => 'required|integer' ,
            'dest_state' => 'required|integer',
            'dest_route_id' => 'required|integer',
            'amount_adult' => 'required' ,
            'amount_child' => 'required' ,
            'class_id' => 'required|integer',
            'route_id' => 'required|integer'
        ]);

        $routeFare = new RouteFare;
        $routeFare->train_location_id                   = $attr['state'];
        $routeFare->train_stop_id                       = $attr['route_id'];
        $routeFare->train_destination_id                = $attr['dest_state'];
        $routeFare->train_terminal_destination_stop_id  = $attr['dest_route_id'];
        $routeFare->amount_adult                        = $attr['amount_adult'];
        $routeFare->amount_child                        = $attr['amount_child'];
        $routeFare->train_class_id                      = $attr['class_id'];
        $routeFare->save();

        Alert::success('Success', 'Route fare  Added Successfully');

        return back();
    }


    public function fetchStateRoutes($state_id)
    {
        $cities = DB::table("train_stops")
            ->where("train_location_id",$state_id)
            ->select("id","stop_name")->get();

        return json_encode($cities);
    }

    public function trainHistory($train_id)
    {
       $train = \App\Models\Train::where('id',$train_id)->first();
       $schedules = TrainSchedule::where('train_id',$train_id)->orderby('created_at','desc')->get();
//       dd($schedules);

        return view('admin.train.view-schedule' , compact('train','schedules'));
    }

    public function fetchRouteFaresForSchedule($train_schedule_id)
    {
        $routeFare = ScheduleRoute::where('train_schedule_id',$train_schedule_id)->with('routeFare')->get();
        dd($routeFare);
    }


    public function checkSchedule(Request $request)
    {
        $attr = request()->validate([
            'destination_from'  => 'required|integer',
            'destination_to'    => 'required|integer',
            'tripType'          => 'required|integer',
            'passenger'         => 'required|integer',
            'departure_date'    => 'required|date',
            'return_date'       => 'sometimes'
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

//        dd($checkSchedule);

        $tripTypeId = $attr['tripType'];

        if($tripTypeId == 2)
        {
            $setReturnDate = request()->session()->get('return_date');
        }

        $returnDate = $request->return_date;


        return view('pages.train.schedule',compact('checkSchedule','returnDate','tripTypeId'));

    }


    public function trainSeatPicker($train_schedule_id , $train_id , $tripTypeId)
    {
        $trainSeats =  TrainSeatTracker::where('train_schedule_id', $train_schedule_id)
                                ->where('train_id',$train_id)->with(['trainseat' => function($query){
                                     $query->with('trainclass');
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
        $trip_type  = $tripTypeId;


        $routeFare = RouteFare::with('terminal','destination_terminal','seatClass')->get();


        return view('pages.train.seat-picker', compact('trainSeatsPicker','schedule_id','routeFare','tranId','trip_type','train_schedule_id'));



    }


    public function selectSeat(Request $request)
    {
        $attr = request()->validate([
            'train_id' => 'required|integer',
            'train_seat_tracker_id' => 'required|integer',
            'train_schedule_id' => 'required|integer'
        ]);

        $bookSeat = TrainSeatTracker::where('id', $attr['train_seat_tracker_id'])
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


        $bookSeat = TrainSeatTracker::where('id', $attr['train_seat_tracker_id'])
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

            toastr()->error('Error !! Ensure the number of seats selected matches the route picked');

            return back();
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

            toastr()->error('Error !! Ensure the number of seats selected matches the route picked');

            return back();
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

            toastr()->error('Error !! Ensure the seat class picked matched the route class selected');

            return back();
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
            toastr()->error('Error !! Number of seats selected must match the passenger count');
            return  back();
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
            toastr()->error('Error !! Please ensure the gender option is not more than the number of passenger intended for booking');
            return back();
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

        if(Session::has('setReturnDate'))
        {
            $return_date = request()->session()->get('setReturnDate');
        }else{
            $return_date = null;
        }

        $service = \App\Models\Service::where('id',2)->first();

        DB::commit();
//        dd($service);

        return view('pages.train.payment' ,compact('childrenCount','fetchScheduleDetails','adultCount',
            'childrenCount','amount','selectedSeat','ticketType' , 'totalPasseneger','return_date' ,'routeFare','adultFareTotal' ,'childFareTotal' ,'service') );

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
            'transaction' => $transactions
        ];

        $email =  $data["email"];

        Mail::to($email)->send(new \App\Mail\TrainTicket($maildata));

        DB::commit();

        toastr()->success('Success !! Cash Payment made successfully');
        return redirect('/');

    }


}
