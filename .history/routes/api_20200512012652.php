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
Route::get('/getMedia','API\MainController@getMedia');

// UsersController
Route::get('/userInfo','API\UsersController@userInfo');
Route::get('/userPoints','API\UsersController@userPoints');
Route::get('/userBalance','API\UsersController@userBalance');
Route::post('/register', 'API\UsersController@register');
Route::post('/addFamilyMembers', 'API\UsersController@addFamilyMember');
Route::post('/addMessage', 'API\UsersController@addMessage');
Route::get('/getMessages','API\UsersController@getMessages');
Route::get('/getPointsProducts','API\UsersController@getPointsProducts');
Route::post('/replcePoints','API\UsersController@replcePoints');

// DriverController
Route::post('/registerDriver', 'API\DriverController@registerDriver');
Route::post('/loginDriver', 'API\DriverController@loginDriver');

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

// route to get all data in cart for user
Route::get('/getCarts','API\ProductsController@getCarts');

// route to get delivery prices
Route::get('/getDeliveryPrice','API\ProductsController@getDeliveryPrice');

// route to get all cities
Route::get('/getCities','API\ProductsController@getCities');

// route to get all locations based on city
Route::get('/getLocations','API\ProductsController@getLocations');

// route to update item quentity in cart
Route::post('/updateItem','API\ProductsController@updateItem');

// route to add products to cart for user
Route::post('/addToCart','API\ProductsController@addToCart');

// route to share products in cart to another user
Route::post('/shareCart','API\ProductsController@shareCart');

// route to add multiple products to cart for user
Route::post('/addMultiToCart','API\ProductsController@addMultiToCart');

// route to delete products from cart for user
Route::post('/deleteFromCart','API\ProductsController@deleteFromCart');

// route for submit users orders
Route::post('/confirmOrder','API\ProductsController@confirmOrder');

// route for get users orders
Route::post('/myOrders','API\ProductsController@myOrders');



// Route::group(['middleware' => 'auth:api'], function(){
// Route::post('details', 'API\UserController@details');
// });
