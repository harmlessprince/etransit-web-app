<?php

namespace App\Http\Controllers;

use App\Mail\OperatorCredentials;
use App\Mail\PasswordRecovery;
use App\Models\Eticket;
use App\Models\Service;
use App\Models\ServiceTenant;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Bus;
use App\Models\Terminal;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Operator extends Controller
{
    public function operators()
    {
        return  view('admin.operator.all-operator');
    }

    public function fetchOperators(Request $request)
    {
        if ($request->ajax()) {
            $data = Tenant::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/operator/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/view-operator/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }


    public function viewOperator($id)
    {
        $tenant = Tenant::find($id);
        $busCount = Bus::withoutGlobalScopes()->where('tenant_id',$tenant->id)->count();
        $terminalCount = Terminal::withoutGlobalScopes()->where('tenant_id',$tenant->id)->count();
        $transactionSum = \App\Models\Transaction::withoutGlobalScopes()->where('tenant_id',$tenant->id)->pluck('amount')->sum();

        $tenantServiceObject = new \stdClass();

        $services = Service::all();

        foreach($services as $index => $service) {
            if (count($tenant->services) > 0){
                foreach ($tenant->services as $tenantService) {
                    $tenantServiceObject->$index['service'] = $service->name;
                    $tenantServiceObject->$index['id'] = $service->id;
                    $tenantServiceObject->$index['status'] = ($tenantService->name == $service->name) ? 'yes' : 'no';
                    if ($tenantService->name == $service->name) {
                        break;
                    }
                }
            }else{
                $tenantServiceObject->$index['service'] = $service->name;
                $tenantServiceObject->$index['id'] = $service->id;
                $tenantServiceObject->$index['status'] =  'no';
            }
        }

        return view('admin.operator.view-operator', compact('tenant','busCount','terminalCount','tenantServiceObject','transactionSum'));
    }


    public function fetchOperatorUser(Request $request , $id)
    {
        if ($request->ajax()) {
            $data = Eticket::withoutGlobalScopes()->where('tenant_id',$id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/operator-generate-password/$id'  onclick='return confirm(`Are you sure?`)' class='edit btn btn-danger btn-sm mr-3'>Regenerate Password</a>";
                    $actionBtn .= "<a href='/user-proxy/enter/$id/true'  onclick='return confirm(`Are you sure?`)' class='edit btn btn-danger btn-sm'>Impersonate</a>";

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function regeneratePassword($id)
    {
        DB::beginTransaction();

            $operator = Eticket::withoutGlobalScopes()->where('id',$id)->first();
            $userEmail = $operator->email;
            $password  =   Str::random(8);

            $maildata = [
                'name' =>  $operator->full_name,
                'email' => $userEmail,
                'password' => $password,
                'url_link' => env('APP_URL').'/e-ticket',
            ];
            $operator->update([
                'password' => Hash::make($password),
            ]);

        DB::commit();

            Mail::to($userEmail)->send(new PasswordRecovery($maildata));

            Alert::success('Success ', 'Password regenerated for the users successfully');

        return  back();
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
            'company_logo' => 'sometimes',
            'display_name' => 'required'
        ]);

        if($request->hasFile('company_logo'))
        {
            request()->validate([
                'company_logo' => 'mimes:jpeg,jpg,png|max:2048'
            ]);

        }


        DB::beginTransaction();
           $password  =   Str::random(8);

            $tenant = new Tenant();
            $tenant->company_name = $request->company_name;
            $tenant->address = $request->company_address;
            $tenant->phone_number = $request->phone_number;
            $tenant->display_name  = $request->display_name;
            $tenant->image_url = $request->hasFile('company_logo') ?  Cloudinary::upload($request->file('company_logo')->getRealPath())->getSecurePath() : null;
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

        $role =  Role::create(['guard_name' => 'e-ticket','name' => 'Super Admin '.$tenant->display_name ,'tenant_id' => $tenant->id]);

        $eticket->assignRole($role);

        $permissions = Permission::where('guard_name' ,'e-ticket')->get();

        foreach($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }

        Mail::to($request->email)->send(new OperatorCredentials($maildata));

        DB::commit();

        Alert::success('Success ', 'Operator added successfully');

        return redirect('admin/manage/operators');

    }

    public function editOperator($operator_id)
    {
        $operator =   Eticket::where('tenant_id', $operator_id)->with('tenant')->first();

        return view('admin.operator.edit-operator', compact('operator'));
    }


    public function updateOperator(Request $request , $operator_id)
    {
        request()->validate([
            'company_name' => 'required|string',
            'company_address'=> 'required|string',
            'phone_number' => 'required',
            'full_name' => 'required',
            'email' => 'required|email',
            'company_logo' => 'sometimes',
            'display_name' => 'required'
        ]);

        if($request->hasFile('company_logo'))
        {
            request()->validate([
                'company_logo' => 'mimes:jpeg,jpg,png|max:2048'
            ]);
        }

        DB::beginTransaction();
        $findEticketUser = Eticket::find($operator_id);

        $findEticketUser->update([
           'full_name' => $request->full_name,
           'email' => $request->email,
        ]);

        $tenant = Tenant::where('id' , $findEticketUser->tenant_id)->first();

        $tenant->update([
            'company_name' => $request->company_name,
            'address' => $request->company_address,
            'phone_number' => $request->phone_number,
            'display_name' => $request->display_name,
            'image_url' => $request->hasFile('company_logo') ?  Cloudinary::upload($request->file('company_logo')->getRealPath())->getSecurePath() : null,
        ]);;
        DB::commit();

        Alert::success('Success ', 'Operator Edited successfully');

        return redirect('admin/manage/operators');

    }

    public function addServiceToOperator(Request $request)
    {

        if($request->checked == "checked")
        {
            $newserviceTenant = new ServiceTenant();
            $newserviceTenant->service_id = $request->service_id;
            $newserviceTenant->tenant_id  = $request->tenant_id;
            $newserviceTenant->save();
            return response()->json(['success' => true , 'message' => 'Service added to tenant successfully']);
        }else{
            $servicetenant = ServiceTenant::where('tenant_id', $request->tenant_id)->where('service_id', $request->service_id)->first();
            $servicetenant->delete();
            return response()->json(['success' => true , 'message' => 'Service  removed  successfully']);
        }


    }
}
