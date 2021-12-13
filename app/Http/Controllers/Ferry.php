<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ferry extends Controller
{
    public function index()
    {
        return view('admin.ferry.index');
    }
}
