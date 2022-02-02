<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Terminal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class EticketTerminal extends Controller
{
    public function allTerminals()
    {
        return view('Eticket.terminal.index');
    }

    public function fetchTerminal(Request $request)
    {
        if ($request->ajax()) {
            $data = Terminal::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-tenant-bus/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addTerminal()
    {
        $locations = Destination::all();
        return view('Eticket.terminal.add-terminal' , compact('locations'));
    }

    public function storeAddress(Request $request)
    {
        request()->validate([
            'terminal_address' => 'required',
            'terminal_name' => 'required',
            'location'=> 'required|integer'
        ]);


        $terminal = new Terminal;
        $terminal->terminal_name = $request->terminal_name;
        $terminal->terminal_address = $request->terminal_address;
        $terminal->tenant_id = session()->get('tenant_id');
        $terminal->destination_id = $request->location;
        $terminal->save();

        Alert::success('Success ', 'Terminal added successfully');

        return redirect('e-ticket/terminals');

    }
}
