<?php

namespace App\Http\Controllers\Eticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageBus extends Controller
{
    public function allBuses()
    {

        return view('Eticket.bus.index');
    }
}
