<?php

namespace App\Http\Controllers;

use App\Exports\TerminalsExport;


use App\Imports\TerminalImport;
use Illuminate\Http\Request;
use App\Models\Terminal as BusTerminal;
use Maatwebsite\Excel\Facades\Excel;

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
