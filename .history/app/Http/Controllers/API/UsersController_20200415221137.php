<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;

class UsersController extends Controller
{
    // get all user information
    public function userInfo(Request $request)
    {
        $user = User::select('image','order')->get();
        return response()->json([
            'user_info' => $user,
        ]);
    }

    // Register new user
    public function register(Request $request)
    {
        $image = $request->get('image');  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $request->get('phone') . '.png';

        Storage::disk('local')->put($imageName, base64_decode($image));

        $input = $request->all();
        $input['phone'] = $input['phone'];
        $input['image'] = 'http://127.0.0.1:8000/'.$imageName;
        $input['email'] = $input['email'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        return response()->json(['access_token'=>$success], $this-> successStatus);
    }
}
