<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use App\Models\UserTrustee;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorizationConsole extends Controller
{
    public function authorizeTrustee()
    {
        return view('pages.authorization.index');
    }

    public function AcceptAuthorizationRequest(Request $request)
    {
        $data =   $request->validate(['pin' => 'required']);

        $userTrusteeCode = UserTrustee::where('code', $data['pin'])->first();
        if(! $userTrusteeCode)
        {
            Alert::error('Oops ', 'Incorrect Token');
            return back();
        }

        //else if token is correct
        //check if user is a trustee
        $tracker =  $userTrusteeCode->tracker_id;
        //check wether the tracker is still active
        $TrackedUser = Tracker::where('id', $tracker)->where('status' , 'active')->first();

        if(!$TrackedUser)
        {
            Alert::error('Oops ', 'Seems tracking session already ended by the user');
            return back();
        }

        session()->put('authorization_pin', $data['pin']);

        return redirect('tracker/'.$tracker.'/user');

    }
}
