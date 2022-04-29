<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Controller
{
    public function myProfile()
    {
        $services = Service::all();
//        dd($services);

        return view('pages.profile.my-profile' , compact('services'));
    }


    public function myTransactions($user_id , $service_id)
    {
        $transactions = \App\Models\Transaction::where('service_id', $service_id)
                                    ->with('schedule','carhistory')->where('user_id',$user_id)
                                    ->orderby('created_at','desc')->simplePaginate(25);
//        dd( $transactions);
//
        $service = Service::where('id',$service_id)->first();


        return view('pages.profile.my-transactions',compact('transactions','service_id','service'));

    }

    public function updateUserProfile(Request $request , $user_id)
    {
         $request->validate([
             'full_name' => 'required',
             'phone_number' => 'required',
             'address' => 'required',
             'password' => 'sometimes',
             'confirm_password'=>'sometimes'
         ]);

            $update_user = \App\Models\User::where('id',$user_id)->firstorfail();



            if(!is_null($request->password))
            {
                    if($request->password != $request->confirm_password)
                    {
                        toastr()->error('Your password does not match');
                        return back();
                    }else{
                        $update_user->update([
                            'full_name' => $request->full_name,
                            'phone_number' => $request->phone_number,
                            'address' => $request->address,
                            'password' => Hash::make($request->password),
                        ]);
                    }
                }else{
                    $update_user->update([
                        'full_name' => $request->full_name,
                        'phone_number' => $request->phone_number,
                        'address' => $request->address
                    ]);
                }

            toastr()->success('Profile Updated successfully');
            return back();
        }


}
