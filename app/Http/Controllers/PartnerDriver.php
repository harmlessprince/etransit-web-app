<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PartnerDriver as Driver;
use App\Mail\DriverCredentials;
use App\Models\Eticket;
use App\Models\ServiceTenant;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;

class PartnerDriver extends Controller
{
    public function drivers(){
        return view('admin.drivers.index');
    }
    public function fetchDrivers(Request $request){
        if ($request->ajax()) {
            $data = Driver::where('isApproved',true)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('experience', function($driver){
                    $yearsOfExp = $driver->experience." Years";
                    return $yearsOfExp;
                })
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/manage/drivers/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function driverDetails($driverId){
        $driver =Driver::find($driverId);

        return view('admin.drivers.profile',compact('driver'));
    }
    public function onboardDriver(){
        return view('admin.drivers.onboarding');
    }
    public function StoreOnboardDriver(Request $request){
        $data =   request()->validate([
            'full_name'        => 'required',
            'username'     => 'required|unique:partner_drivers',
            'email'            => 'required|email|unique:partner_drivers',
            'home_address' => 'required',
            'experience'      => 'required|integer',
            'phone' => 'required|unique:partner_drivers',
            'license' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'utilityornin' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'dob' => 'required|date'
        ]);

       $utility = $request->file('utilityornin');
       $license = $request->file('license');
       $utilityBillurl = Cloudinary::upload($utility->getRealPath())->getSecurePath();
       $licenseUrl = Cloudinary::upload($license->getRealPath())->getSecurePath();






        DB::beginTransaction();

        $driver =Driver::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'home_address' => $data['home_address'],
            'experience' => $data['experience'],
            'phone'=> $data['phone'],
            'utility_or_nin' => $utilityBillurl,
            'license' => $licenseUrl,
            'convoy' => $request->has('convoy'),
            'light_commercial' => $request->has('light_commercial'),
            'commercial'=> $request->has('commercial'),
            'trucks' => $request->has('trucks'),
            'industrial' => $request->has('industrial'),
            'notes' => $request->notes,
            'self_managed' => $request->self_managed=="true"? 1 : 0,
            'date_of_birth' => $request->dob

       ]);

        $checkTenant = Tenant::where('phone_number' , $driver->phone)->first();

        if(!is_null($checkTenant))
        {
            Alert::error('Error ', 'Partner already exists as Operator');

            return back();
        }

        $password  =   Str::random(8);

        $tenant = new Tenant();
        $tenant->company_name  = $driver->username;
        $tenant->address       = $driver->home_address;
        $tenant->phone_number  = $driver->phone;
        $tenant->display_name  = $driver->full_name;
        $tenant->save();

        if($tenant)
        {
            $eticket = new Eticket;
            $eticket->full_name = $driver->full_name;
            $eticket->email     = $driver->email;
            $eticket->password  = Hash::make($password);
            $eticket->tenant_id = $tenant->id;
            $eticket->save();
        }

        $maildata = [
            'name' =>  $driver->full_name,
            'email' => $driver->email,
            'password' => $password,
            'url_link' => env('APP_URL').'/e-ticket',

        ];

        $role =  Role::create(['guard_name' => 'e-ticket','name' => 'Super Admin '.$tenant->company_name ,'tenant_id' => $tenant->id]);

        $eticket->assignRole($role);

        $permissions = Permission::where('guard_name' ,'e-ticket')->get();

        foreach($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }

        //assign user to driver service
        $service = \App\Models\Service::where('name' , 'Driver')->first();
        $newserviceTenant = new ServiceTenant();
        $newserviceTenant->service_id = $service->id;
        $newserviceTenant->tenant_id  = $tenant->id;
        $newserviceTenant->save();

        $driver->update([
            'isApproved' => true,
            'approvedAt' => date('Y-m-d H:i:s'),
            'tenant_id'=> $tenant->id
        ]);


        Mail::to($driver->email)->send(new DriverCredentials($maildata));


        DB::commit();

        toastr()->success("Driver application approved");
        return redirect(url('/admin/manage/drivers'));
    }
    public function editRate(Request $request){
         request()->validate([
            'rate' => 'required|numeric|min:1000'
         ]);

        Driver::find($request->id)->update([
            'daily_rate' => $request->rate
         ]);

         toastr()->success('Rate set Successfully');
         return redirect()->back();
    }
}
