<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\FamilyMembers;

class UsersController extends Controller
{
    // get all user information , by Access Token
    public function userInfo(Request $request)
    {
        $user = Auth::user();
        $familyMembers = FamilyMembers::where('user_id', $user->id)->get();
        return response()->json([
            'user_info' => $user,
            'family_members' => $familyMembers,
        ]);
    }

    // Register new user
    public function register(Request $request)
    {
        if($request->get('access_token') == ''){
            $image = $request->get('image');  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'User_Pic_'.$request->get('phone') . '.png';
            // add image to public folder
            Storage::disk('local')->put('images/'.$imageName, base64_decode($image));

            $user = new User;
            $user->phone = $request->get('phone');
            $user->image = 'http://127.0.0.1:8000/'.$imageName;
            $user->email = $request->get('email');
            $user->location = $request->get('location');
            $user->save();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['access_token'=>$success, 'request' => $imageName]);
        } else {
            $user = Auth::user();
            $image = $request->get('image');  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $request->get('phone') . '.png';
            // add image to public folder
            Storage::disk('local')->put($imageName, base64_decode($image));

            $user->phone = $request->get('phone');
            $user->image = 'http://127.0.0.1:8000/'.$imageName;
            $user->email = $request->get('email');
            $user->location = $request->get('location');
            $user->salary = $request->get('salary');
            $user->save();
            return response()->json(['success'=>$user]);
        }
    }

    // Add Family Members Function
    public function addFamilyMember(Request $request)
    {
        $user = Auth::user();
        $familyMembers = new FamilyMembers;
        $familyMembers->user_id = $user->id;
        $familyMembers->name = $request->get('name');
        $familyMembers->gender = $request->get('gender');
        $familyMembers->age = $request->get('age');
        $familyMembers->save();
        return response()->json(['success'=>$familyMembers]);
    }
}
