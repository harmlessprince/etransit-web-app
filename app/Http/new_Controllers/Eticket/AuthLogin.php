<?php

namespace App\Http\new_Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Eticket;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AuthLogin extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
//        $this->middleware('guest:e-ticket')->except('logout');
    }

    public function eticketLogin()
    {
        return view('Eticket.Auth.login');
    }

//    public function fetchUser(Request $request)
//    {
//          $data  =  request()->validate([
//                'email' => 'required|exists:etickets',
//            ]);
//
//          $user = Eticket::where('email' ,'=', $data['email'])->with('tenant')->first();
//
//          if(!$user)
//          {
//              Alert::error('Warning ', 'Oops !! , seems you dont have access to this platform');
//
//              return back();
//          }
//
//          session()->put('tenant_id', $user->tenant_id);
//
//          return view('Eticket.Auth.authenticate',compact('user'));
//    }

    public function loginTenant(Request $request)
    {
        request()->validate([
            'email'   => 'required|email|exists:etickets',
            'password' => 'required'
        ]);

        if (Auth::guard('e-ticket')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('e-ticket/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function dashboard()
    {
        $users = Eticket::all();
//        $company_name = \App\Models\Tenant::where('id',session()->get('tenant_id'))->first();
        $carHireTransaction = Transaction::where('tenant_id',session()->get('tenant_id'))->where('service_id',6)->pluck('amount')->sum();
        $busBookingTransaction = Transaction::where('tenant_id',session()->get('tenant_id'))->where('service_id',1)->pluck('amount')->sum();
        $totalTransaction = Transaction::where('tenant_id',session()->get('tenant_id'))->pluck('amount')->sum();
        $todayTransaction = Transaction::where('tenant_id',session()->get('tenant_id'))->whereDate('created_at', Carbon::today())->pluck('amount')->sum();

        $tranx = \App\Models\Transaction::where('tenant_id',session()->get('tenant_id'))->select(
                                                        DB::raw("year(created_at) as year"),
                                                        DB::raw("SUM(amount) as total_amount"))
                                                        ->orderBy(DB::raw("YEAR(created_at)"))
                                                        ->groupBy(DB::raw("YEAR(created_at)"))
                                                        ->get();


        $result[] = ['Year','Amount'];

        foreach ($tranx as $key => $value) {

            $result[++$key] = [$value->year, (double)$value->total_amount];

        }

      return view('Eticket.dashboard.index' , compact('users','carHireTransaction','busBookingTransaction','todayTransaction','totalTransaction'))->with('transactions',json_encode($result));
    }

    public function logout()
    {
        Auth::guard('e-ticket')
            ->logout();
        return redirect()
            ->route('e-ticket.login-page');
    }

    protected function guard()
    {
        return Auth::guard('e-ticket');
    }
}
