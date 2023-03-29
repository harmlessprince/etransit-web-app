<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Exports\DriverExport;
use App\Imports\DriverImport;
use Illuminate\Http\Request;
use App\Models\Driver as TenantDriver;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


use DataTables;

class Driver extends Controller
{
    public function drivers()
    {

        return view('Eticket.driver.all-driver');
    }

    public function fetchDrivers(Request $request)
    {
        if ($request->ajax()) {
            $data = TenantDriver::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-driver/$id'  class='edit btn btn-success btn-sm'>Edit</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getBulkUploadPage() 
    {
        return view('Eticket.driver.import');
    }

    public function importDriver(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);
        
         Excel::import(new DriverImport, $request->excel_file);
         Alert::success('Success', 'Data imported successfully');
        return back();
    }

    public function exportDriver()
    {
        $tenant_id = session()->get('tenant_id');
        $drivers = DB::table('drivers')->where('tenant_id', $tenant_id)->select('full_name', 'address', 'phone_number')->get();
        return Excel::download(new DriverExport($drivers), 'drivers.xlsx');
    }

    public function createDriver()
    {
        return view('Eticket.driver.new-driver');
    }

    public function storeDriver(Request $request)
    {
        request()->validate([
            'full_name' => 'required',
            'phone_number' => 'required|unique:drivers',
            'address'=> 'required'
        ]);

        $newDriver = new TenantDriver;
        $newDriver->full_name = $request->full_name;
        $newDriver->phone_number = $request->phone_number;
        $newDriver->address = $request->address;
        $newDriver->tenant_id = session()->get('tenant_id');

        Alert::success('Success ', 'Driver added successfully');

        $newDriver->save();

        return redirect('e-ticket/drivers');
    }

    public function editDriver($driver_id)
    {
        $driver = TenantDriver::find($driver_id);

        return view('Eticket.driver.edit-driver', compact('driver'));
    }

    public function updateDriver(Request $request , $driver_id)
    {
        $driver = TenantDriver::find($driver_id);

        $driver->update([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'tenant_id' => session()->get('tenant_id')
        ]);

        Alert::success('Success ', 'Driver information updated successfully');


        return redirect('e-ticket/drivers');
    }
}
