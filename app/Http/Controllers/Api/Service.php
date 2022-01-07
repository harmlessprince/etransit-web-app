<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service as ETransitService;

class Service extends Controller
{
    public function services()
    {
      $services  =  ETransitService::all();

      return response()->json(['success' => true , 'data' => compact('services')], 200);
    }

    public function searchServices(Request $request)
    {

       $data = request()->validate(['search' => 'required']);

                  !$data ?  abort(404)
                    : $result = ETransitService::query()
                                ->whereLike('name', $data['search'])
                                ->get();

      return response()->json(['success' => true ,'data' => compact('result')]);
    }
}
