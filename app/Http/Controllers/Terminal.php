<?php

namespace App\Http\Controllers;

use App\Exports\TerminalsExport;


use App\Imports\TerminalImport;
use App\Models\Bus;
use Illuminate\Http\Request;
use App\Models\Terminal as BusTerminal;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class Terminal extends Controller
{
    public function Terminals()
    {
        $terminals = BusTerminal::all();
        return view('admin.terminal.terminal' , compact('terminals'));
    }

    public function AddTerminal(Request $request)
    {
           $data = request()->validate([
                'terminal_name'=> 'required',
                'terminal_address' => 'required'
            ]);


           $terminal = new BusTerminal();
           $terminal->terminal_name = $data['terminal_name'];
           $terminal->terminal_address = $data['terminal_address'];
           $terminal->save();

           return response()->json(['success' => true , 'message' => 'Terminal created successfully']);
    }


    public function allTenantsTerminal()
    {
        return view('admin.terminal.tenant-terminal');
    }

    public function fetchTenantsTerminal(Request $request)
    {
        if ($request->ajax()) {
            $data = BusTerminal::withoutGlobalScopes()->with('tenant','destination')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-terminal/$id' class='delete btn btn-success btn-sm'>View</a>";
//                    <a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a>
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function viewTerminal($terminal_id)
    {
        $terminal = BusTerminal::withoutGlobalScopes()->where('id',$terminal_id)->with('tenant','destination')->first();

        return view('admin.terminal.view-terminal' , compact('terminal'));
    }


    public function importExportViewTerminal()
    {
        return view('admin.terminal.import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportTerminal()
    {
        $terminals = BusTerminal::select(["id", "terminal_name", "terminal_address"])->get();

        return Excel::download(new TerminalsExport($terminals), 'terminal.xlsx');

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importTerminal(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new TerminalImport,request()->file('excel_file'));

        toastr()->success('Data saved successfully');

        return response()->json(['message' => 'uploaded successfully'], 200);
    }
}
