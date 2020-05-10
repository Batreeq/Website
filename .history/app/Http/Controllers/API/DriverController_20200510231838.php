<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Media;
use App\Drivers;

class DriverController extends Controller
{
     // Register new user
     public function registerDriver(Request $request)
     {
             $user = new Media;
             $user->name = $request->get('first_name') . ' ' . $request->get('last_name');
             $user->phone = $request->get('phone');
             $user->password = Hash::make($request->get('password'));
             $user->driver_token = hash('sha256', Str::random(60));
             $user->second_phone = $request->get('second_phone');
             $user->location = $request->get('location');
             $user->car = $request->get('car');
             $user->car_model = $request->get('car_model');
             $user->save();

             return response()->json(['user'=>$user]);
     }
}
