<?php

namespace App\Http\new_Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Mail\EticketUser;
use App\Models\Eticket;
use App\Models\Staff;

use App\Models\Tenant;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class StaffMgt extends Controller
{
    public function allStaff()
    {
        return view('Eticket.staff.all-staff');
    }

    public function fetchStaffs(Request $request)
    {
        if ($request->ajax()) {
            $data = Staff::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/store-edit/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-staff/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function createStaff()
    {
        return view('Eticket.staff.create');
    }


    public function storeStaff(Request $request)
    {
        request()->validate([
            'full_name' => 'required',
            'phone_number' => 'required|unique:staffs',
            'designation' => 'required',
            'email' => 'required|email|unique:staffs',
            'address'=> 'required',
            'employment_date' => 'sometimes'
        ]);

        $staff = new Staff;
        $staff->full_name = $request->full_name;
        $staff->email = $request->email;
        $staff->phone_number = $request->phone_number;
        $staff->designation = $request->designation;
        $staff->address = $request->address;
        $staff->employment_date = $request->employment_date;
        $staff->tenant_id = session()->get('tenant_id');
        $staff->save();

        Alert::success('Success ', 'Staff added successfully');

        return redirect('e-ticket/staffs');

    }

    public function editStaff($staff_id)
    {
        $staff = Staff::find($staff_id);

        return view('Eticket.staff.edit' , compact('staff'));
    }

    public function updateStaff(Request $request , $staff_id)
    {
        request()->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'designation' => 'required',
            'email' => 'required|email',
            'address'=> 'required',
            'employment_date' => 'sometimes'
        ]);
        $staff = Staff::find($staff_id);
        $staff->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'designation' => $request->designation,
            'employment_date' => $request->employment_date,
        ]);

        Alert::success('Success ', 'Staff updated successfully');

        return redirect('e-ticket/staffs');
    }

    public function viewStaff($staff_id)
    {
        $staff = Staff::find($staff_id);

        return view('Eticket.staff.view-staff' , compact('staff'));

    }


    public function terminateAppointment($staff_id)
    {
        $staff = Staff::find($staff_id);

        $staff->update([
            'termination_date' => now(),
        ]);
        Alert::success('Success ', 'Staff Appointment terminated successfully');
        return back();
    }


    public function enableAppointment($staff_id)
    {
        $staff = Staff::find($staff_id);

        $staff->update([
            'termination_date' => null,
        ]);
        Alert::success('Success ', 'Staff Appointment has been approved successfully');
        return back();
    }

    public function assignRole($staff_id)
    {
        $staff = Staff::find($staff_id);
        $roles =  Role::where(['guard_name' => 'e-ticket'])->where('tenant_id', session()->get('tenant_id'))->get();


        return view('Eticket.staff.assign-role',compact('staff','roles'));
    }

    public function assignUserRole(Request $request , $staff_id)
    {

        request()->validate([
            'role' => 'required|integer',
        ]);

        $staff = Staff::find($staff_id);
        $tenant = Tenant::where('id',session()->get('tenant_id'))->first();

        $password = Str::random(6);

        if($staff)
        {
            $eticket = new Eticket;
            $eticket->full_name = $staff->full_name;
            $eticket->email = $staff->email;
            $eticket->password = Hash::make($password);
            $eticket->tenant_id = session()->get('tenant_id');
            $eticket->save();
        }


        $role =  Role::where(['guard_name' => 'e-ticket'])->where('tenant_id',$tenant->id)->first();

        $eticket->assignRole($role);

        $maildata = [
            'name' =>  $staff->full_name,
            'email' => $staff->email,
            'password' => $password,
        ];

        Mail::to($staff->email)->send(new EticketUser($maildata));

        Alert::success('Success ', 'User has been assign a role successfully');

        return back();
    }
}
