<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terminal as BusTerminal;

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
}
