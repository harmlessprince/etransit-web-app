<?php

namespace App\Http\Middleware;

use App\Models\Tracker;
use App\Models\UserTrustee;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RequestForAuthorizationPin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if(session()->has('authorization_pin'))
       {
           $trackingSession = session()->get('authorization_pin');

           $userTrusteeCode = UserTrustee::where('code',  $trackingSession)->first();

           if(!$userTrusteeCode)
           {
               Alert::error('Oops ', 'Incorrect Token');
               return back();
           }

           $tracker =  $userTrusteeCode->tracker_id;

           $TrackedUser = Tracker::where('id', $tracker)->where('status' , 'active')->first();

           if(!$TrackedUser)
           {
               Alert::error('Oops ', 'Seems tracking session already ended by the user');
               return back();
           }

           return $next($request);
       }

       return redirect('authorization/page');

    }
}
