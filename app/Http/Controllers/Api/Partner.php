<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner as OurPartners;

class Partner extends Controller
{
    public function store(Request $request)
    {
            $data   =  request()->validate([
                        'full_name' => 'required',
                        'email' => 'required|email',
                        'company_name' => 'required',
                        'phone_number' => 'required'
                    ]);

            try {
                $partners = new OurPartners();
                $partners->full_name = $data['full_name'];
                $partners->email  = $data['email'];
                $partners->company_name = $data['company_name'];
                $partners->phone_number = $data['phone_number'];
                $partners->save();

                return response()->json(['success' => true , 'message' => 'Request sent successfully']);

              } catch (\Exception $e) {

                return response()->json(['success' => false  , 'message' =>  $e->getMessage()]);

              }

    }
}
