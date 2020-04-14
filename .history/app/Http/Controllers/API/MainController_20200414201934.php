<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen()
    {
        return "test3";
    }
}
