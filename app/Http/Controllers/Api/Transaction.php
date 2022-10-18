<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;

class Transaction extends Controller
{
    public function userTransactions()
    {
        $userID = auth()->user()->id;

        $fetchTransactions = Tranx::where('user_id','=' ,$userID)->with('service')->paginate(10);

        return response()->json(['success' => true , 'data' => compact('fetchTransactions')]);
    }
}
