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
        $homeSliders = HomeSlider::select('image','order');
        return $homeSliders;
    }
}
