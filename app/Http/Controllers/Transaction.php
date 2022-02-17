<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;
use RealRashid\SweetAlert\Facades\Alert;

class Transaction extends Controller
{
    public function allTransactions()
    {
        $transactions  = Tranx::with('schedule','user')->orderBy('created_at','desc')->Simplepaginate(30);

        return view('admin.transactions.transaction', compact('transactions'));
    }


    public function viewTransaction($transaction_id)
    {
       $transaction = Tranx::where('id',$transaction_id)->with('user','schedule','tenant')->first();

//   dd($transaction);

       return view('admin.transactions.view-transaction' , compact('transaction'));
    }

    public function approveTransaction($transaction_id)
    {
        $tranx = Tranx::where('id',$transaction_id)->first();

        if(!$tranx){
            Alert::error('Error', 'Transaction not found');
        }

        $tranx->update([
            'status' => 'Successful',
            'isConfirmed' => 'True'
        ]);
        Alert::success('Success', 'Transaction approved successfully');
        return back();
    }
}
