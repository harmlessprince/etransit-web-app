<?php

namespace App\Http\Controllers;

use App\Mail\OperatorCredentials;
use App\Models\Eticket;
use App\Models\Tenant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

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
                    $actionBtn = "<a href='/admin/customer/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/view-operator/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }


    public function viewOperator($id)
    {
        $tenant = Tenant::find($id);

        return view('admin.operator.view-operator', compact('tenant'));
    }


    public function fetchOperatorUser(Request $request , $id)
    {
        if ($request->ajax()) {
            $data = Eticket::where('tenant_id', $id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/customer/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/view-operator/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

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

        Mail::to($request->email)->send(new OperatorCredentials($maildata));
        DB::commit();

        Alert::success('Success ', 'Operator added successfully');

        return redirect('admin/manage/operators');

    }
}
