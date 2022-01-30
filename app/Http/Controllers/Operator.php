<?php

namespace App\Http\Controllers;

use App\Mail\OperatorCredentials;
use App\Models\Eticket;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class Operator extends Controller
{
    public function operators()
    {
        return  view('admin.operator.all-operator');
    }

    public function createOperator()
    {
        return view('admin.operator.create-operator');
    }

    public function storeOperator(Request $request)
    {
        request()->validate([
            'company_name' => 'required|string|unique:tenants',
            'company_address'=> 'required|string',
            'phone_number' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:etickets',
        ]);

        DB::beginTransaction();
           $password  =   Str::random(8);

            $tenant = new Tenant();
            $tenant->company_name = $request->company_name;
            $tenant->address = $request->company_address;
            $tenant->phone_number = $request->phone_number;
            $tenant->save();

            if($tenant)
            {
                $eticket = new Eticket;
                $eticket->full_name = $request->full_name;
                $eticket->email = $request->email;
                $eticket->password = Hash::make($password);
                $eticket->tenant_id = $tenant->id;
                $eticket->save();
            }

        $maildata = [
            'name' =>  $request->full_name,
            'email' => $request->email,
            'password' => $password,
            'url_link' => env('APP_URL').'/e-ticket',

        ];

        Mail::to($request->email)->send(new OperatorCredentials($maildata));
        DB::commit();



        return back();

    }
}
