<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// route for splash screen request
Route::get('/splash','API\MainController@splashScreen');

// route for search from products
Route::get('/search','API\ProductsController@search');

// route for get products based on category id
Route::get('/productCategory','API\ProductsController@categorize');

// route for get all products
Route::get('/products','API\ProductsController@products');
