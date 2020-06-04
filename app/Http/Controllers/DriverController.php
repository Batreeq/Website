<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function driver_home()
    {
        return view('drivers.driver_home');
    }
    public function driver_requests()
    {
        return view('drivers.driver_requests');
    }
    public function driver_list()
    {
        return view('drivers.driver_list');
    }
    public function driver_details($id)
    {
        return view('drivers.driver_details');
    }
    public function driver_pending_request()
    {
        return view('drivers.driver_pending_requests');
    }
    public function driver_running_requests()
    {
        return view('drivers.driver_running_requests');
    }
     public function driver_chat()
    {
        return view('drivers.driver_chat');
    }

}
