<?php

namespace App\Http\new_Controllers\Eticket;

use DataTables;
use App\Models\NyscHub;
use App\Models\Terminal;
use App\Classes\NyscRepo;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class EticketTerminal extends Controller
{
    public function allTerminals()
    {
        return view('Eticket.terminal.index');
    }

    public function fetchTerminal(Request $request)
    {
        if ($request->ajax()) {
            $data = Terminal::with('destination')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-terminal/$id'  class='edit btn btn-success btn-sm'>Edit</a>";
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

    public function editTerminal($terminal_id)
    {
        $terminal = Terminal::with('destination')->find($terminal_id);
        $locations = Destination::all();

        return view('Eticket.terminal.edit-terminal' , compact('locations','terminal'));
    }

    public function updateTerminal(Request $request , $terminal_id)
    {
        $terminal =  Terminal::find($terminal_id);

        $terminal->update([
            'terminal_name' => $request->terminal_name,
            'terminal_address' => $request->terminal_address,
            'tenant_id' => session()->get('tenant_id'),
            'destination_id' => $request->location,
        ]);

        Alert::success('Success ', 'Terminal updated successfully');

        return redirect('e-ticket/terminals');
    }

    public function addNyscHub(){
        $hubs = NyscHub::with('location')->get();
        $locations = Destination::whereDoesntHave('nyscHub')->get();
        return view('Eticket.terminal.add-nysc-hub', compact('hubs','locations'));
    }

    public function storeNyscHub(Request $request){
       $checkLocation = NyscHub::where('location_id',$request->location_id)->count();
       if($checkLocation<1){
            NyscRepo::addHub($request->location_id,$request->terminal_name,$request->terminal_address);
            Alert::success('Success', 'Hub added successfully');
       }
       else{
           Alert::error('Error', 'Hub already exists for this location');

       }
       return redirect('e-ticket/nysc/hubs');
    }
}
