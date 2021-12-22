<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\TrainClass;
use App\Models\TrainLocation;
use App\Models\TrainSeat;
use App\Models\TrainStop;
use Illuminate\Http\Request;
use App\Models\Train as TrainTicket;
use Illuminate\Support\Facades\DB;
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
                    'train_stop' => 'required|string' ,
                    'amount_adult' => 'required' ,
                    'amount_child' => 'required' ,
                    'class_id' => 'required|integer'
                    ]);

      $trainStop = new TrainStop;
      $trainStop->train_location_id = $attr['state'];
      $trainStop->train_class_id    = $attr['class_id'];
      $trainStop->stop_name         = $attr['train_stop'];
      $trainStop->amount_adult      = $attr['amount_adult'];
      $trainStop->amount_child      = $attr['amount_child'];
      $trainStop->save();

      Alert::success('Success', 'Train Stop  Added Successfully');

      return back();
    }


    public function manageSchedule($train_id)
    {
        $train = TrainTicket::where('id' , $train_id)->firstorfail();

        $trainRoutes = TrainStop::all();
//        dd($train);

        return view('admin.train.schedule', compact('train','trainRoutes'));
    }


    public function trainHistory($train_id)
    {

    }

}
