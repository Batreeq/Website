<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
