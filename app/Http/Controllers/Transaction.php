<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;

class Transaction extends Controller
{
    public function allTransactions()
    {
        $transactions  = Tranx::with('schedule','user')->get();

        return view('admin.transactions.transaction', compact('transactions'));
    }
}
