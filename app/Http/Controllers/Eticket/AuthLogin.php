<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Eticket;
use App\Models\EticketPasswordRequest;
use App\Models\Tenant;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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

    /**
     * @throws ValidationException
     */
    public function loginTenant(Request $request)
    {
        request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);


        if (!Auth::guard('e-ticket')->attempt($request->only('email', 'password'), $request->get('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials!',
                'password' => 'Invalid credentials!',
            ]);
        }

        return redirect()->intended('e-ticket/dashboard');
    }

    public function dashboard()
    {
        $users = Eticket::all();
//        $company_name = \App\Models\Tenant::where('id',session()->get('tenant_id'))->first();
        $carHireTransaction = Transaction::where('tenant_id', session()->get('tenant_id'))->where('service_id', 6)->pluck('amount')->sum();
        $busBookingTransaction = Transaction::where('tenant_id', session()->get('tenant_id'))->where('service_id', 1)->pluck('amount')->sum();
        $totalTransaction = Transaction::where('tenant_id', session()->get('tenant_id'))->pluck('amount')->sum();
        $todayTransaction = Transaction::where('tenant_id', session()->get('tenant_id'))->whereDate('created_at', Carbon::today())->pluck('amount')->sum();

        $tranx = Transaction::where('tenant_id', session()->get('tenant_id'))->select(
            DB::raw("year(created_at) as year"),
            DB::raw("SUM(amount) as total_amount"))
            ->orderBy(DB::raw("YEAR(created_at)"))
            ->groupBy(DB::raw("YEAR(created_at)"))
            ->get();


        $result[] = ['Year', 'Amount'];

        foreach ($tranx as $key => $value) {

            $result[++$key] = [$value->year, (double)$value->total_amount];

        }

        return view('Eticket.dashboard.index', compact('users', 'carHireTransaction', 'busBookingTransaction', 'todayTransaction', 'totalTransaction'))->with('transactions', json_encode($result));
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

    public function viewUserProfile()
    {
        $userId = Auth::guard('e-ticket')->user()->id;
        $tenantId = session()->get('tenant_id');
        $user = Eticket::where('id', $userId)->first();
        $tenant = Tenant::where('id', $tenantId)->first();
        return view('Eticket.auth.view-profile', compact('user', 'tenant'));
    }

    public function updateUserProfile(Request $request, $id)
    {
        $user = Eticket::where('id', $id)->first();
        if ($request->full_name) $user->full_name = $request->full_name;
        if ($request->email) $user->email = $request->email;
        $user->save();
        Alert::success('success', 'Your profile information has been successfully updated');

        return redirect('e-ticket/user-profile');
    }

    public function changePassword()
    {
        $userId = Auth::guard('e-ticket')->user()->id;
        $user = Eticket::where('id', $userId)->first();

        return view('Eticket.auth.change-password', compact('user'));
    }

    public function sendPasswordChangeRequest(Request $request, $id)
    {
        $eticket = Eticket::where('id', $id)->first();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'reenter_password' => 'required',
            // 'reenter_password' === 'new_password',
        ]);
        $hashedPassword = $eticket->password;
        $currentPassword = $request->current_password;

        if (Hash::check($currentPassword, $hashedPassword)) {
            $eticketPaswordRequest = EticketPasswordRequest::firstOrNew(['eticket_id' => $id]);
            $eticketPaswordRequest->new_password = Hash::make($request->new_password);
            $eticketPaswordRequest->admin_approval = false;
            $eticketPaswordRequest->save();
            Alert::success('success', 'A Password change request has been sent to the admin, pending their approval!');
            return redirect('e-ticket/dashboard');

        } else {
            Alert::error('Error', 'Something went wrong!');
            return redirect('e-ticket/dashboard');
        }
    }

}
