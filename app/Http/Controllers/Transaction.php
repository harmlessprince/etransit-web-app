<?php

namespace App\Http\Controllers;

use App\Models\Eticket;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;
use PdfReport;

use RealRashid\SweetAlert\Facades\Alert;

class Transaction extends Controller
{
    public function allTransactions()
    {

        $services = Service::all();

        $serviceObject = new \stdClass();

        foreach($services as $index => $service) {
            if($service->name != 'Flight Booking' && $service->name !='Hotel Booking' )
            {
                $serviceObject->$index['id'] = $service->id;
                $serviceObject->$index['service'] = $service->name;
            }
        }

        $serviceData  = $serviceObject;



        $transactions  = Tranx::with('schedule','user')
                            ->orderBy('created_at','desc')
                            ->Simplepaginate(30);
        if(!is_null(request()->start_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','>=',request()->start_date)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);

        }

        if(!is_null(request()->end_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','<=',request()->end_date)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);

        }


        if(!is_null(request()->end_date) && !is_null(request()->start_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','>=',request()->start_date)
                ->whereDate('created_at','<=',request()->end_date)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);

        }

        if(!is_null(request()->service_type))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('service_id',request()->service_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }


        if(!is_null(request()->service_type)  && !is_null(request()->start_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','>=',request()->start_date)
                ->where('service_id',request()->service_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->service_type)  && !is_null(request()->end_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','<=',request()->end_date)
                ->where('service_id',request()->service_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->service_type)  && !is_null(request()->start_date)  && !is_null(request()->end_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','>=',request()->start_date)
                ->whereDate('created_at','<=',request()->end_date)
                ->where('service_id',request()->service_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->transaction_status))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('status',request()->transaction_status)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }


        if(!is_null(request()->transaction_status)  && !is_null(request()->start_date) &&  !is_null(request()->end_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('status',request()->transaction_status)
                ->whereDate('created_at','>=',request()->start_date)
                ->whereDate('created_at','<=',request()->end_date)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->transaction_status)  && !is_null(request()->service_type) &&
            !is_null(request()->start_date) &&  !is_null(request()->end_date))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('status',request()->transaction_status)
                ->whereDate('created_at','>=',request()->start_date)
                ->whereDate('created_at','<=',request()->end_date)
                ->where('service_id',request()->service_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->payment_type))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('transaction_type',request()->payment_type)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->reference))
        {
            $transactions  = Tranx::with('schedule','user')
                ->where('reference',request()->reference)
                ->orderBy('created_at','desc')
                ->Simplepaginate(30);
        }

        if(!is_null(request()->passenger_email))
        {
            $user = User::where('email', request()->passenger_email)->first();
            if($user){
                $transactions  = Tranx::with('schedule','user')
                    ->where('user_id',$user->id)
                    ->orderBy('created_at','desc')
                    ->Simplepaginate(30);
            }else{
                Alert::error('Error', 'User with the email not found');
//                return back();
            }

        }

        if(!is_null(request()->operator_email))
        {
            $operator = Eticket::where('email', request()->operator_email)->first();
            if($operator){
                $transactions  = Tranx::with('schedule','user')
                    ->where('tenant_id',$operator->id)
                    ->orderBy('created_at','desc')
                    ->Simplepaginate(30);
            }else{
                Alert::error('Error', 'User with the email not found');
//                return back();
            }
        }


        return view('admin.transactions.transaction', compact('transactions','serviceData'));
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

    public function exportCsv(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $defaultPaginator = 100;
        $setPaginator = $request->set_paginator ?? $defaultPaginator;


        $operator = Eticket::where('email', request()->operator_email)->with('tenant')->first();


        if(!$operator){
            Alert::error('Error', 'Operator with the email not found');
        }else{
            $fileName = $operator->tenant->display_name.' Transaction Report.csv';
            $transactions  = Tranx::with('schedule','user')
                ->whereDate('created_at','>=',request()->start_date)
                ->whereDate('created_at','<=',request()->end_date)
                ->where('tenant_id',$operator->id)
                ->orderBy('created_at','desc')
                ->take($setPaginator)->get();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Reference', 'Amount', 'Status', 'CustomerEmail', 'TransactionDate');

            $callback = function() use($transactions , $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($transactions  as $transaction) {
                    $row['Reference']    = $transaction->reference;
                    $row['Amount']  = $transaction->amount;
                    $row['Status']    = $transaction->status;
                    $row['Customer Email']  = $transaction->user->email;
                    $row['Transaction Date']  =  $transaction->created_at;

                    fputcsv($file, array($row['Reference'], $row['Amount'], $row['Status'], $row['Customer Email'], $row['Transaction Date']));

                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        return back();
    }
}
