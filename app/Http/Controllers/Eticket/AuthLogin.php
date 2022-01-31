<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Eticket;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function fetchUser(Request $request)
    {
          $data  =  request()->validate([
                'email' => 'required|exists:etickets',
            ]);

          $user = Eticket::where('email', $data['email'])->with('tenant')->first();

          session()->put('tenant_id', $user->tenant_id);

          return view('Eticket.Auth.authenticate',compact('user'));
    }

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
      return view('Eticket.dashboard.index' , compact('users'));
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
