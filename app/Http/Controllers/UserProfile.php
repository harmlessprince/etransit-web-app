<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Controller
{
    public function myProfile(Request $request)
    {
        $services = Service::all();
//        dd($services);

        return view('pages.profile.my-profile' , compact('services'));
    }

    public function getMyTransactions(Request $request)
    {
        $results = \App\Models\Transaction::where('user_id', auth()->user()->id)->orderBy('id')->paginate(3);
        $transactions = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $transactions.= '
                    <div class="col-md-4" style="padding-top: 5px;padding-left: 40px;padding-right: 40px;padding-bottom: 5px;">
                    <div class="row" style="border-radius: 10px;box-shadow: 1px 0px 10px rgb(231,232,232);padding: 15px;">
                        <div class="col">
                            <div class="row" style="border-bottom: 4px none rgb(120,120,120) ;">
                                <div class="col" style="border-bottom: 1px solid rgb(208,208,208) ;">
                                    <p style="margin-bottom: 3px;"><strong>'. $result->service->name .' Transaction</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="padding-left: 0px;border-bottom: 1px solid rgb(208,208,208) ;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-md-flex" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;">Amount</p>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p class="text-end" style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                                    <strong>N '. number_format($result->amount) .'</strong></p>
                                </div>
                                <div class="col-6 d-md-flex" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;">Payment Type</p>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p class="text-end" style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                                        <a href="" class="view_transactions">'. Ucfirst($result->transaction_type) .'</a>
                                    </p>
                                </div>
                               <div class="col-6 d-md-flex" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;">View Transactions</p>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p class="text-end" style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;text-align: right;">

                                        <a href="{{url(\'view-user-transaction/\'.$result->id)}}"
                                           class="view_transactions">
                                           View Details
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="padding-left: 0px;border-bottom: 1px none rgb(208,208,208) ;">
                                    <div class="input-group mb-3">
                                    <span id="basic-addon1" class="input-group-text" style="margin-left: 0px;border-right-style: none;">
                                    <i class="fab fa-cc-mastercard" id="inputicon" style="margin-top: 1px;"></i></span>
                                      <input class="placeholder form-control no-radius" type="text" id="removeradius" aria-label="Username" aria-describedby="basic-addon1" style="background: rgb(218,222,225);border: 2px solid rgb(206,212,218) ;border-right-style: solid;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            return $transactions;
        }

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
