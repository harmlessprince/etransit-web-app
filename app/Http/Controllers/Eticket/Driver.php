<?php

namespace App\Http\Controllers\Eticket;

use App\Exports\DriverExport;
use App\Http\Controllers\Controller;
use App\Imports\DriverImport;
use App\Models\Driver as TenantDriver;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;


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
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-driver/$id'  class='edit btn btn-success btn-sm mr-1'>Edit</a>";
                    $actionBtn = $actionBtn . "<a href='/e-ticket/show-driver/$id'  class='btn btn-info btn-sm'>View</a>";
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
            'full_name' => ['required', 'string', 'max:200'],
            'phone_number' => ['required', 'unique:drivers'],
            'address' => ['required', 'string', 'max:200'],
            'nin' => ['required', 'string'],
            'license' => ['required', 'image', 'max:200'],
            'guarantor_name' => ['required', 'string', 'max:200'],
            'guarantor_phone_number' => ['required', 'string', 'max:200'],
            'guarantor_picture' => ['required', 'image', 'max:200'],
            'picture' => ['required', 'image', 'max:200'],
        ]);
        if ($request->hasFile('license')) {
            $file = $request->file('license');
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $license = $uploadedFileUrl;
        }

        if ($request->hasFile('guarantor_picture')) {
            $file = $request->file('guarantor_picture');
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $guarantor_picture = $uploadedFileUrl;
        }

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $picture = $uploadedFileUrl;
        }


        $newDriver = new TenantDriver;
        $newDriver->full_name = $request->full_name;
        $newDriver->phone_number = $request->phone_number;
        $newDriver->address = $request->address;
        $newDriver->nin = $request->nin;
        $newDriver->license = $license ?? null;
        $newDriver->picture = $picture ?? null;
        $newDriver->guarantor_name = $request->input('guarantor_name') ?? null;
        $newDriver->guarantor_phone_number = $request->input('guarantor_phone_number') ?? null;
        $newDriver->guarantor_picture = $guarantor_picture ?? null;
        $newDriver->tenant_id = session()->get('tenant_id');
        $newDriver->save();

        Alert::success('Success ', 'Driver added successfully');

        return redirect('e-ticket/drivers');
    }

    public function editDriver($driver_id)
    {
        $driver = TenantDriver::find($driver_id);

        return view('Eticket.driver.edit-driver', compact('driver'));
    }

    public function showDriver($driver_id)
    {
        $driver = TenantDriver::find($driver_id);
        return view('Eticket.driver.show-driver', compact('driver'));
    }

    public function updateDriver(Request $request, $driver_id)
    {
        $data = [
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'nin' => $request->nin,
            'tenant_id' => session()->get('tenant_id')
        ];
        $driver = TenantDriver::find($driver_id);

        if ($file = $request->file('license')) {
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $data['license'] = $uploadedFileUrl;
        }

        $driver->update($data);

        Alert::success('Success ', 'Driver information updated successfully');


        return redirect('e-ticket/drivers');
    }
}
