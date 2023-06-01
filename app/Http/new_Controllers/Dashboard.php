<?php

namespace App\Http\new_Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class Dashboard extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest');

    }



    public function dashboard()
    {
        $BusService = Service::where('id', 1)->first();
        $TrainService = Service::where('id', 2)->first();
        $ferryService = Service::where('id', 3)->first();
        $carHireService = Service::where('id', 6)->first();
        $boatCruiseService = Service::where('id', 7)->first();
        $tourService = Service::where('id', 8)->first();
        $parcelService = Service::where('id', 9)->first();


        $busBookingTransaction = Transaction::where('service_id' ,$BusService->id)->pluck('amount')->sum();
        $trainBookingTransaction = Transaction::where('service_id' ,$TrainService->id)->pluck('amount')->sum();
        $ferryBookingTransaction = Transaction::where('service_id' ,$ferryService->id)->pluck('amount')->sum();
        $carHireBookingTransaction = Transaction::where('service_id' ,$carHireService->id)->pluck('amount')->sum();
        $boatCruiseBookingTransaction = Transaction::where('service_id' ,$boatCruiseService->id)->pluck('amount')->sum();
        $tourBookingTransaction = Transaction::where('service_id' ,$tourService->id)->pluck('amount')->sum();
        $parcelBookingTransaction = Transaction::where('service_id' ,$parcelService->id)->pluck('amount')->sum();
        $allTransactions = Transaction::pluck('amount')->sum();

        $schedules = \App\Models\Schedule::with('terminal','bus','destination','pickup')->orderby('created_at','desc')->take(10)->get();
//        dd($schedules );

        $tranx = \App\Models\Transaction::select(
                    DB::raw("year(created_at) as year"),
                    DB::raw("SUM(amount) as total_amount"))
                    ->orderBy(DB::raw("YEAR(created_at)"))
                    ->groupBy(DB::raw("YEAR(created_at)"))
                    ->get();


        $result[] = ['Year','Amount'];

        foreach ($tranx as $key => $value) {

            $result[++$key] = [$value->year, (double)$value->total_amount];

        }


        $busCount = \App\Models\Bus::withoutGlobalScopes()->count();
        $schedulesCount = \App\Models\Schedule::count();
        $operatorCount = \App\Models\Eticket::count();



        return view('admin.index' , compact('busBookingTransaction' ,
            'trainBookingTransaction','ferryBookingTransaction',
            'carHireBookingTransaction','boatCruiseBookingTransaction',
            'tourBookingTransaction','parcelBookingTransaction',
            'allTransactions','schedules','busCount','schedulesCount','operatorCount'))->with('transactions',json_encode($result));
    }


    public function login()
    {
        return 'login page';
    }
}
