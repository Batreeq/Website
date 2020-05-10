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
        if($driver){
            Hash::check('INPUT PASSWORD', $driver->password);
        }

        if (Auth::guard('drivers')->attempt(['phone' => , 'password' => $request->get('password')])) {
            // The user is active, not suspended, and exists.
            return 'success';
        } else {
            return "خطأ في رقم الهاتف او كلمة المرور أو لم يتم قبولك بعد";
        }
    }
}
