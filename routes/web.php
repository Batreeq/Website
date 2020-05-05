<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('homepage');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('homepage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('homepage');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('homepage')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	    Route::get('admin-add', ['as' => 'pages.admin-add', 'uses' => 'UserController@admin_add_screen']);
	    Route::get('products-categories', ['as' => 'pages.product-category', 'uses' => 'PageController@products_categories']);
		Route::get('products', ['as' => 'pages.products', 'uses' => 'products@index']);
		Route::get('product-add', ['as' => 'pages.product-add', 'uses' => 'products@add']);
		Route::get("categories", ['as' => 'pages.category', 'uses' => 'Categories@index']);
		Route::get('work-us', ['as' => 'pages.work-us', 'uses' => 'PageController@work_us']);
		Route::get('work-us-screens', ['as' => 'pages.work-us-screens', 'uses' => 'PageController@work_us_screen']);
		Route::get('app-pages', ['as' => 'pages.app-pages', 'uses' => 'PageController@app_pages']);
        Route::get('different-parts', ['as' => 'pages.different-parts', 'uses' => 'PageController@different_parts']);
        Route::get('edit-different-parts', ['as' => 'pages.edit-different-parts', 'uses' => 'PageController@edit_different_parts']);
    	Route::get('offers-screens', ['as' => 'pages.offers-screens', 'uses' => 'PageController@offers_screens']);
    	Route::get('addProductToOffer', ['as' => 'pages.offers-screens', 'uses' => 'PageController@addProductToOffer']);
    	Route::get('deleteOffer', ['as' => 'pages.offers-screens', 'uses' => 'PageController@deleteOffer']);
		Route::get('delivery', ['as' => 'pages.delivery', 'uses' => 'PageController@delivery']);
		Route::get('delivery-screens', ['as' => 'pages.delivery-screens', 'uses' => 'PageController@region_delivery_screen']);
		Route::get('users', ['as' => 'pages.users', 'uses' => 'UserController@index']);
		Route::get('win-with-us', ['as' => 'pages.win-with-us', 'uses' => 'PageController@win_with_us']);
		Route::get('copons', ['as' => 'pages.copons', 'uses' => 'PageController@copons']);
		Route::get('statistics', ['as' => 'pages.statistics', 'uses' => 'PageController@statistics']);
		Route::get('terms', ['as' => 'pages.terms', 'uses' => 'AppPagesController@terms']);
		Route::get('privacy-policy', ['as' => 'pages.privacy-policy', 'uses' => 'AppPagesController@privacy_policy']);
		Route::get('question', ['as' => 'pages.question', 'uses' => 'AppPagesController@question']);
		Route::get('help', ['as' => 'pages.help', 'uses' => 'AppPagesController@help']);
		Route::get('special-offer', ['as' => 'pages.special-offer', 'uses' => 'Products@specail_offer_screen']);
		Route::get('orders', ['as' => 'pages.orders', 'uses' => 'PageController@orders_screen']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::post("submit","Categories@add");
Route::post("add_product","Products@submit_add");
Route::post("add_offer","Products@add_offer");
Route::get("delete_offer","Products@delete_offer");
Route::post("add_security","AppPagesController@submit_add");
Route::post("add_question","AppPagesController@submit_add_question");
Route::post("add_terms","AppPagesController@submit_add");
Route::post("update_terms","AppPagesController@submit_update");
Route::post("add_policy","AppPagesController@submit_add_privacy_policy");
Route::post("update_policy","AppPagesController@submit_update_privacy_policy");
Route::post("add_question","AppPagesController@submit_add_question");
Route::post("add_help","AppPagesController@submit_add_help");
Route::post("update_help","AppPagesController@submit_update_help");
Route::post("add_special_offer","Products@addSpecialOffer");
Route::post("fetch_regions","PageController@fetch_regions");
Route::post("fetch_regions_price","PageController@fetch_regions_price");
Route::post("add_region_delivery","PageController@add_region_delivery");
Route::post("update_region_delivery","PageController@update_region_delivery");
Route::post("update_copons","Products@update_copons");
Route::post("add_admin","UserController@add_admin");
