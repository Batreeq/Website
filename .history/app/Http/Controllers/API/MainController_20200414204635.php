<?php

namespace App\Http\Controllers\API;


use App\Homeblocks;
use App\HomeSlider;
use App\Help;
use App\PrivacyPolicy;
use App\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen()
    {
        $HomeSliders = HomeSlider::select('image','order')->get();
        $Homeblocks = Homeblocks::select('image','order')->get();
        $Help = Help::select('image','order')->get();
        $PrivacyPolicy = PrivacyPolicy::select('image','order')->get();
        $termsAndConditions = Terms::select('image','order')->get();
        return [
            'homeSliders' => $HomeSliders,
            'homeBlocks' => $Homeblocks,
            'HelpScreen' => $Help,
            'PrivacyPolicy' => $PrivacyPolicy,
            'termsAndConditions' => $termsAndConditions,
        ];
    }
}
