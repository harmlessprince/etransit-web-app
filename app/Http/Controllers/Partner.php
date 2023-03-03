<?php

namespace App\Http\Controllers;

use App\Mail\BecomePartners;
use App\Mail\OperatorCredentials;
use App\Mail\DriverCredentials;
use App\Models\Eticket;
use App\Models\ServiceTenant;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Partner as BecomePartner;
use App\Models\PartnerDriver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;

class Partner extends Controller
{

    public function partnerPage()
    {
        return view('pages.partners.partner');
    }

    public function driverPartnerPage(){
        return view('pages.partners.driver');
    }
    
    public function partners()
    {
        return view('admin.partner.all');
    }

    public function viewPartner($partner_id)
    {
        $partner = BecomePartner::find($partner_id);

        return view('admin.partner.view', compact('partner'));
    }

    public function fetchBecomePartners(Request $request)
    {
        if ($request->ajax()) {
            $data = BecomePartner::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-partners/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function becomePartners(Request $request)
    {
      $data =   $request->validate([
                        'full_name'        => 'required',
                        'company_name'     => 'required|unique:partners',
                        'email'            => 'required|email|unique:partners',
                        'company_address' => 'required',
                        'bus_partner'      => 'sometimes',
                        'phone_number' => 'required|unique:partners',
                        'car_hire' => 'sometimes'
                    ]);

      $newPartner = new BecomePartner();
      $newPartner->full_name = $data['full_name'];
      $newPartner->company_name = $data['company_name'];
      $newPartner->email = $data['email'];
      $newPartner->phone_number = $data['phone_number'];
      $newPartner->company_address = $data['company_address'];
      $newPartner->bus_service = !is_null($request->bus_partner) ? true : null;
      $newPartner->car_hire_service = !is_null($request->car_hire) ? true : null ;
      $newPartner->save();

      Mail::to($data['email'])->send(new BecomePartners($data['company_name']));

      toastr()->success('Your Request sent successfully , we will get back to you');

      return redirect('/');
    }

    public function enablePartnerAsOperator($partner_id)
    {
        $operator = BecomePartner::where('id' , $partner_id)->first();

        //check if tenant already exists
        $checkTenant = Tenant::where('phone_number' , $operator->phone_number)->first();

        if(!is_null($checkTenant))
        {
            Alert::error('Error ', 'Partner already exists as Operator');

            return back();
        }


        DB::beginTransaction();

        $password  =   Str::random(8);

        $tenant = new Tenant();
        $tenant->company_name  = $operator->company_name;
        $tenant->address       = $operator->company_address;
        $tenant->phone_number  = $operator->phone_number;
        $tenant->display_name  = $operator->company_name;
        $tenant->save();

        if($tenant)
        {
            $eticket = new Eticket;
            $eticket->full_name = $operator->full_name;
            $eticket->email     = $operator->email;
            $eticket->password  = Hash::make($password);
            $eticket->tenant_id = $tenant->id;
            $eticket->save();
        }

        $maildata = [
            'name' =>  $operator->full_name,
            'email' => $operator->email,
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

        //if the user selected bus service
        if(!is_null($operator->bus_service))
        {
            $service = \App\Models\Service::where('name' , 'Bus Booking')->first();
            $newserviceTenant = new ServiceTenant();
            $newserviceTenant->service_id = $service->id;
            $newserviceTenant->tenant_id  = $tenant->id;
            $newserviceTenant->save();
        }


        //if the user selected car hire service
        if(!is_null($operator->car_hire_service))
        {
            $service = \App\Models\Service::where('name' , 'Car Hire')->first();
            $newserviceTenant = new ServiceTenant();
            $newserviceTenant->service_id = $service->id;
            $newserviceTenant->tenant_id  = $tenant->id;
            $newserviceTenant->save();
        }


        Mail::to($operator->email)->send(new OperatorCredentials($maildata));

        DB::commit();

        Alert::success('Success ', 'Partner has been added  as operator successfully');

        return redirect('admin/manage/operators');
    }

   
    public function newDrivers(){
        return view('admin.partner.drivers');
    }
    public function viewDriver($driverid){
        $driver = PartnerDriver::find($driverid);

        return view('admin.partner.viewdriver', compact('driver'));
    }

    public function fetchDriverApplications(Request $request){
        if ($request->ajax()) {
            $data = PartnerDriver::where('isApproved',false)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('experience', function($driver){
                    $yearsOfExp = $driver->experience." Years";
                    return $yearsOfExp;
                })
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-partner/driver/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function registerDriverApplication(Request $request){
        $data =   $request->validate([
            'full_name'        => 'required',
            'username'     => 'required|unique:partner_drivers',
            'email'            => 'required|email|unique:partner_drivers',
            'home_address' => 'required',
            'experience'      => 'required|integer',
            'phone' => 'required|unique:partner_drivers',
            'license' => 'required|mimes:jpg,jpeg,png|max:2048',
            'utility_or_nin' => 'required|mimes:jpg,jpeg,png|max:2048',
            'dob' => 'required|date'
        ]);

       $utility = $request->file('utility_or_nin');
       $license = $request->file('license');
       $utilityBillurl = Cloudinary::upload($utility->getRealPath())->getSecurePath();
       $licenseUrl = Cloudinary::upload($license->getRealPath())->getSecurePath();

       PartnerDriver::create([
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
            'self_managed' => $request->self_managed == "true" ? 1 : 0,
            'date_of_birth' => $request->dob

       ]);

       toastr()->success('Your Request has been received successfully , we will get back to you soon');

       return redirect('/');

    }

    public function ApproveDriverApplication($driverid){
        $driver = PartnerDriver::find($driverid);
        //check if tenant already exists
        $checkTenant = Tenant::where('phone_number' , $driver->phone)->first();

        if(!is_null($checkTenant))
        {
            Alert::error('Error ', 'Partner already exists as Operator');

            return back();
        }


        DB::beginTransaction();

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
}
