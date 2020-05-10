<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;
use App\Drivers;

class DriverController extends Controller
{
     // Register new user
     public function registerDriver(Request $request)
     {
         if($request->get('api_token') == ''){
             $ifUser = Media::where('phone', $request->get('phone'))->first();
             if($ifUser){
                 return response()->json(['user'=>$ifUser]);
             }
             $image = $request->get('image');  // your base64 encoded
           //$image = str_replace('data:image/png;base64,', '', $image);
           //$image = str_replace('data:image/jpeg;base64,', '', $image);
           //$image = str_replace(' ', '+', $image);
             $imageName = 'User_Pic_'.$request->get('phone') . '.png';
             // add image to public folder

             file_put_contents(public_path('/images/').$imageName, base64_decode($image));

             $user = new User;
             $user->phone = $request->get('phone');
             $user->image = 'https://jaraapp.com/images/'.$imageName;
             $user->email = $request->get('email');
             $user->name = $request->get('name');
             $user->location = $request->get('location');
             $user->api_token = hash('sha256', Str::random(60));
             $user->save();

             $success['token'] =  $user->createToken('MyApp')->accessToken;
             $userData = User::find($user->id);

             $user_statistics = new UserStatistics;
             $user_statistics->user_id = $user->id;
             $user_statistics->using_count = 1;
             $user_statistics->using_months = 0;
             $user_statistics->using_avg = 1;
             $user_statistics->purchase_count = 0;
             $user_statistics->purchase_months = 0;
             $user_statistics->purchase_avg = 0;
             $user_statistics->purchase_amount = 0;
             $user_statistics->start_date = date('Y-m-d');
             $user_statistics->save();

             return response()->json(['user'=>$userData]);
         } else {
             $user = User::where('api_token', $request->get('api_token'))->first();
             $image = $request->get('image');  // your base64 encoded
             $image = str_replace('data:image/png;base64,', '', $image);
             $image = str_replace(' ', '+', $image);
             $image = str_replace('data:image/jpeg;base64,', '', $image);
             $imageName = $request->get('phone') . '.png';
             // add image to public folder
             file_put_contents(public_path('/images/').$imageName, base64_decode($image));

             $user->phone = $request->get('phone');
             $user->image = 'https://jaraapp.com/images/'.$imageName;
             $user->email = $request->get('email');
             $user->name = $request->get('name');
             $user->location = $request->get('location');
             $user->salary = $request->get('salary');
             $user->save();
             return response()->json(['user'=>$user]);
         }
     }
}
