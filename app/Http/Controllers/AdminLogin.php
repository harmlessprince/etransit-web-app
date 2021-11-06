<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class AdminLogin extends Controller
{
    protected $redirectTo = '/dashboard';

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
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')
            ->attempt($request->only(['email', 'password'])))
        {
            return redirect()
                ->route('dashboard');
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
            ->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
