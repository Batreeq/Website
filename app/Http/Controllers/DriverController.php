<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function driver_home()
    {
        return view('drivers.driver_home');
    }
}
