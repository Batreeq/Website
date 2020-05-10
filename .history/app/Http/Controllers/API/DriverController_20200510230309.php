<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Media;
use App\Drivers;

class DriverController extends Controller
{
     // Register new user
     public function registerDriver(Request $request)
     {
             $user = new Media;
             $user->phone = $request->get('phone');
             $user->image = 'https://jaraapp.com/images/';
             $user->email = $request->get('email');
             $user->name = $request->get('name');
             $user->location = $request->get('location');
             $user->api_token = hash('sha256', Str::random(60));
             $user->save();

             return response()->json(['user'=>$user]);
     }
}
