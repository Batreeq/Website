<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen(Request $request)
    {
        $Homeblocks = Product::all();
        return response()->json([
            'homeSliders' => $Homeblocks,
        ]);
    }

}
