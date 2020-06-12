<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Media;
use App\Drivers;

class DriverController extends Controller
{
    // Register new driver
    public function registerDriver(Request $request)
    {
        $drivers = new Drivers;
        $drivers->name = $request->get('first_name') . ' ' . $request->get('last_name');
        $drivers->phone = $request->get('phone');
        $drivers->password = Hash::make($request->get('password'));
        $drivers->driver_token = hash('sha256', Str::random(60));
        $drivers->second_phone = $request->get('second_phone');
        $drivers->location = $request->get('location');
        $drivers->car = $request->get('car');
        $drivers->car_model = $request->get('car_model');
        $drivers->status = 'pending';
        $drivers->save();

        return response()->json(['driver'=>$drivers, 'message' => 'تم تقديم طلب تسجيلك بنجاح يرجى انتظار قبولك للعمل كسائق']);
    }

    // Register new driver
    public function loginDriver(Request $request)
    {
        $driver = Drivers::where('phone', $request->get('phone'))->first();
        if(!$driver){
            return response()->json(['success'=>false, 'message' => 'رقم الهاتف غير موجود']);
        }
        if (!Hash::check($request->get('password'), $driver->password)) {
            return response()->json(['success'=>false, 'message' => 'كلمة المرور خاظئة, يرجى المحاولة مرة اخرى']);
        }
        if($driver->status == 'pending'){
            return response()->json(['success'=>false, 'message' => 'عذراً لم يتم قبولك كسائق بعد']);
        }
        return response()->json(['success'=>true,'message'=>'success', 'driver' => $driver]);
    }

    // change driver availablity
    public function driverAvailablity(Request $request)
    {
        $driver = Drivers::where('driver_token', $request->get('driver_token'))->first();
        if($request->get('available') == 'true'){
            $driver->availablity = 'true';
        } else {
            $driver->availablity = 'false';
        }
        $driver->save();
        return response()->json(['driver' => $driver->name,'available'=>$driver->availablity]);
    }

    

    // change driver availablity
    public function driverDetails(Request $request)
    {
        $driver = Drivers::where('driver_token', $request->get('driver_token'))->first();
        if($request->get('available') == 'true'){
            $driver->availablity = 'true';
        } else {
            $driver->availablity = 'false';
        }
        $driver->save();
        return response()->json(['driver' => $driver->name,'available'=>$driver->availablity]);
    }


}
