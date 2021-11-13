<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Bus extends Controller
{
    public function search(Request $request)
    {

            
            $keyword = $request->input('bus_name');
//    Log::info($keyword);
            $buses = DB::table('buses')->where('name','like','%'.$keyword.'%')
                ->select('bus.id','bus.name')
                ->get();
            return json_encode($buses);

    }
}
