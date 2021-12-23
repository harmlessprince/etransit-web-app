<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrainClass;
use App\Models\TrainLocation;
use App\Models\TrainSchedule;
use App\Models\TrainSeatTracker;
use App\Models\TripType;
use Illuminate\Http\Request;
use App\Models\Train as TrainTicket;

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


    public function trainSeat($train_id)
    {
        $train = TrainTicket::where('id',$train_id)->with(['trainseats' => function($query){
                                                            $query->with('trainclass')->get();
                                                        }])->first();

        return  response()->json(['success' => true , 'data' => compact('train')]);
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
}
