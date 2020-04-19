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

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen()
    {
        $categories = Category::all();
        $HomeSliders = HomeSlider::select('image','order')->get();
        $Homeblocks = Homeblocks::all();
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

}
