<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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


    public function nextOfKin($tracking_id): \Illuminate\Http\JsonResponse
    {
        $userID = auth()->user()->id;

        $nextOfKin = UserTrustee::where('tracker_id',$tracking_id)->first();

        return response()->json(['success' => true , 'data' => compact('nextOfKin')]);
    }
}
