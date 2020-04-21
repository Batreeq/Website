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
Route::get('/userPoints','API\UsersController@userPoints');
Route::post('/register', 'API\UsersController@register');
Route::post('/addFamilyMembers', 'API\UsersController@addFamilyMember');


// ProductsController
// route for search from products
Route::get('/search','API\ProductsController@search');

// route to get products based on category id
Route::get('/productCategory','API\ProductsController@categorize');

// route to get all products based on offer id
Route::get('/products','API\ProductsController@products');

// route to get all categories
Route::get('/categories','API\ProductsController@categories');

// route to get all data in cart for user
Route::get('/getUserCart','API\ProductsController@getUserCart');

// route to add products to cart for user
Route::post('/addToCart','API\ProductsController@addToCart');

// route to delete products from cart for user
Route::post('/deleteFromCart','API\ProductsController@deleteFromCart');

// route for submit users orders
Route::post('/confirmOrder','API\ProductsController@confirmOrder');

// route for get users orders
Route::post('/myOrders','API\ProductsController@myOrders');



// Route::group(['middleware' => 'auth:api'], function(){
// Route::post('details', 'API\UserController@details');
// });
