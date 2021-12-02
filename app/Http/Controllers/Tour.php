<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class Tour extends Controller
{
    public function tourPackageList()
    {

        $service = Service::where('id', 8)->firstorfail();

        return view('pages.tour-packages.list', compact('service'));
    }


    public function tourPackageShow()
    {
        $service = Service::where('id', 8)->firstorfail();

        return view('pages.tour-packages.show', compact('service'));
    }
}
