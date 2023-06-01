<?php

namespace App\Http\new_Controllers;

use Illuminate\Http\Request;
use DB;

class Bus extends Controller
{
    public function search(Request $request)
    {
            $keyword = $request->input('bus_name');
            $buses = DB::table('buses')->where('name','like','%'.$keyword.'%')
                ->select('bus.id','bus.name')
                ->get();
            return json_encode($buses);
    }
}
