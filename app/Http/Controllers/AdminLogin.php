<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RealRashid\SweetAlert\Facades\Alert;

class AdminLogin extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function loginAdmin(Request $request)
    {
        request()->validate([
            'email'   => 'required|email|exists:admins',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

//            Alert::success('Congrats', 'You\'ve Successfully Registered');
//            toastr()->success('Successfully logged in ...');
            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }



    public function logout()
    {
        Auth::guard('admin')
            ->logout();
        return redirect()
            ->route('admin.login.page');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
