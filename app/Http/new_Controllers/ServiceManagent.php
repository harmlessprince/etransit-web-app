<?php

namespace App\Http\new_Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceManagent extends Controller
{
    public function allServices()
    {
        $services = Service::all();

        return view('admin.service.all-service' , compact('services'));
    }

    public function activateOrDeactivateService(Request $request)
    {

        $service = Service::find($request->serviceId);

        if(!$service)
        {
            return response()->json(['success'=> false , 'message' => 'Service not found']);
        }


        if($request->checked == 'checked')
        {
            $service->update(['status' => 'active']);

            return response()->json(['success' => true , 'message' => 'Service activated successfully']);
        }else{
            $service->update(['status' => 'inactive']);
            return response()->json(['success' => true , 'message' => 'Service deactivated successfully']);
        }

    }

}
