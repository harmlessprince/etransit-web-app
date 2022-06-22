<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transaction as Tranx;
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
}
