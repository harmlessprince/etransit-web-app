<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terminal;

class Schedule extends Controller
{
    public function scheduleEvent($terminal_id)
    {
         $terminal =  Terminal::where('id',$terminal_id)->with('service')->first();

         return view('admin.schedule.event' , compact('terminal'));

    }
}
