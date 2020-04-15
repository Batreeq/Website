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

// MainController
// route for splash screen request
Route::get('/splash','API\MainController@splashScreen');


// UsersController
// route to get all user info
Route::get('/userInfo','API\UsersController@userInfo');
Route::put('/register', 'API\UsersController@register');
Route::post('/addFamilyMembers', 'API\UsersController@addFamilyMember');


// ProductsController
// route for search from products
Route::get('/search','API\ProductsController@search');

// route to get products based on category id
Route::get('/productCategory','API\ProductsController@categorize');

// route to get all products
Route::get('/products','API\ProductsController@products');

// route to get all categories
Route::get('/categories','API\ProductsController@categories');

// route to get all data in cart for user
Route::get('/getUserCart','API\ProductsController@getUserCart');




// Route::group(['middleware' => 'auth:api'], function(){
// Route::post('details', 'API\UserController@details');
// });
