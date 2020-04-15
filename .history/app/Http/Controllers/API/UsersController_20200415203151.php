<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
