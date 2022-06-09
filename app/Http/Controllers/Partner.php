<?php

namespace App\Http\Controllers;

use App\Mail\BecomePartners;
use App\Mail\OperatorCredentials;
use App\Models\Eticket;
use App\Models\ServiceTenant;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Partner as BecomePartner;
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
                        'car_hire' => 'sometimes',
                        'notes' => 'sometimes'
                    ]);

      $newPartner = new BecomePartner();
      $newPartner->full_name = $data['full_name'];
      $newPartner->company_name = $data['company_name'];
      $newPartner->email = $data['email'];
      $newPartner->phone_number = $data['phone_number'];
      $newPartner->company_address = $data['company_address'];
      $newPartner->notes = $data['notes'];
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

}
