<?php

namespace App\Http\Controllers\API;


use App\Homeblocks;
use App\HomeSlider;
use App\Help;
use App\PrivacyPolicy;
use App\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\User;

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen()
    {
        $HomeSliders = HomeSlider::select('image','order')->get();
        $Homeblocks = Homeblocks::select('image','name','order')->get();
        $Help = Help::select('title','text')->get();
        $PrivacyPolicy = PrivacyPolicy::select('title','text')->get();
        $termsAndConditions = Terms::select('title','text')->get();
        return response()->json([
            'homeSliders' => $HomeSliders,
            'homeBlocks' => $Homeblocks,
            'HelpScreen' => $Help,
            'PrivacyPolicy' => $PrivacyPolicy,
            'termsAndConditions' => $termsAndConditions,
        ]);
    }

    // get all user information
    public function userInfo(Request $request)
    {
        $user = User::select('image','order')->get();
        return response()->json([
            'user_info' => $user,
        ]);
    }
}
