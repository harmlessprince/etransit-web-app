<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParcelMgt extends Controller
{
    public function parcel()
    {
        return view("pages.parcel.index");
    }
}
