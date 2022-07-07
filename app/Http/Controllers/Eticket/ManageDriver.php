<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PartnerDriver;

class ManageDriver extends Controller
{
    public function driverDetails($driverId){
        $driver =PartnerDriver::find($driverId);

        return view('eticket.partner-driver.profile',compact('driver'));
    }

    public function editRate(Request $request){
        request()->validate([
           'rate' => 'required|numeric|min:1000'
        ]);

       PartnerDriver::find($request->id)->update([
           'daily_rate' => $request->rate
        ]);

        toastr()->success('Rate set Successfully');
        return redirect()->back();
   }
}
