<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Tracker;
use App\Models\UserTrustee;
use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;

class Transaction extends Controller
{
    public function userTransactions()
    {
        $userID = auth()->user()->id;

        $fetchTransactions = Tranx::where('user_id','=' ,$userID)->orderBy('created_at', 'DESC')->with('service', 'tracker')->paginate(10);

        return response()->json(['success' => true , 'data' => compact('fetchTransactions')]);
    }


    public function nextOfKin(): \Illuminate\Http\JsonResponse
    {
        $userID = auth()->user()->id;

        $passenger = Passenger::whereUserId($userID)->first();
        if($passenger){
            $nextOfKin = [
              'full_name' => $passenger->next_of_kin_name,
              'number' => $passenger->next_of_kin_number
            ];
            return response()->json(['success' => true , 'data' => compact('nextOfKin')], 200);
        }



        return response()->json(['success' => false , 'message' => 'No last Passenger']);
    }

    public function getTracker($id)
    {
        $userID = auth()->user()->id;
        $tracker = Tracker::whereId($id)->with('tracking_details')->first();

        if($tracker){
            return response()->json(['success' => true , 'data' => compact('tracker')]);
        }

        return response()->json(['success' => false , 'message' => 'Error fetching tracker details']);
    }
}
