<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drivers;

class DriverController extends Controller
{
    public function driver_home()
    {
        return view('drivers.driver_home');
    }
    public function driver_requests()
    {    
        $data_drivers=Drivers::where('status','=','pending')->get();
        return view('drivers.driver_requests',['drivers' => $data_drivers]);
    }
    public function driver_requests_approved ()
    {    
        if(isset($_GET['id'])){
            Drivers::where('id', '=',$_GET['id'])->update([
                'status'=>'approved',
                'updated_at' => date("Y-m-d h:i:s")
            ]);
        }
        return back()->with('success','تم تعديل معلومات المنتج بنجاح');
    }
    public function driver_requests_declined()
    {    
         if(isset($_GET['id'])){
            Drivers::where('id', '=',$_GET['id'])->update([
                'status'=>'declined',
                'updated_at' => date("Y-m-d h:i:s")
            ]);
        }
        return back()->with('success','تم تعديل معلومات المنتج بنجاح');
    }
    public function driver_list()
    {  
        $data_drivers=Drivers::where('status','=','approved')->get();
        return view('drivers.driver_list',['drivers' => $data_drivers]);
    }
    public function driver_details($id)
    {
        $data_drivers=Drivers::where('id','=',$id)->get();
        return view('drivers.driver_details',['drivers' => $data_drivers[0]]);
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
