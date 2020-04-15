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
        $imageName = $request->phone . '.png';

        Storage::disk('local')->put($imageName, base64_decode($image));
        $input = $request->all();
        $input['phone'] = $input['phone'];
        $input['phone'] = $input['phone'];
        $input['phone'] = $input['phone'];
        $input['phone'] = $input['phone'];
        $input['phone'] = $input['phone'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
}
