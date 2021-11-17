<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Admin;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLogin extends Controller
{
    use AuthenticatesUsers;



//    protected $redirectTo = '/admin/dashboard';

//    public function __construct()
//    {
//        $this->middleware('guest:admin')->except('logout');
//    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function loginAdmin(Request $request)
    {

       $credentials =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')
            ->attempt($request->only(['email', 'password'])))
        {

            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()
              ->back()
              ->with('error', 'Invalid Credentials');



 }

    public function logout()
    {
        Auth::guard('admin')
            ->logout();
        return redirect()
            ->route('admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
