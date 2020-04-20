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

Route::get('/homepage', function () {
    return view('homepage');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});


// Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	    Route::get('products-categories', ['as' => 'pages.product-category', 'uses' => 'PageController@products_categories']);
		Route::get('products', ['as' => 'pages.products', 'uses' => 'products@index']);
		Route::get('product-add', ['as' => 'pages.product-add', 'uses' => 'products@add']);
		Route::get("categories", ['as' => 'pages.category', 'uses' => 'Categories@index']);
		Route::get('work-us', ['as' => 'pages.work-us', 'uses' => 'PageController@work_us']);
		Route::get('app-pages', ['as' => 'pages.app-pages', 'uses' => 'PageController@app_pages']);
        Route::get('different-parts', ['as' => 'pages.different-parts', 'uses' => 'PageController@different_parts']);
        Route::get('offers-screens', ['as' => 'pages.offers-screens', 'uses' => 'PageController@offers_screens']);
        Route::get('addProductToOffer', ['as' => 'pages.offers-screens', 'uses' => 'PageController@addProductToOffer']);
        Route::get('deleteOffer', ['as' => 'pages.offers-screens', 'uses' => 'PageController@deleteOffer']);
		Route::get('delivery', ['as' => 'pages.delivery', 'uses' => 'PageController@delivery']);
		Route::get('users', ['as' => 'pages.users', 'uses' => 'PageController@users']);
		Route::get('win-with-us', ['as' => 'pages.win-with-us', 'uses' => 'PageController@win_with_us']);
		Route::get('copons', ['as' => 'pages.copons', 'uses' => 'PageController@copons']);
		Route::get('statistics', ['as' => 'pages.statistics', 'uses' => 'PageController@statistics']);
		Route::get('security', ['as' => 'pages.security', 'uses' => 'AppPagesController@security']);
		Route::get('policy', ['as' => 'pages.policy', 'uses' => 'AppPagesController@policy']);
		Route::get('question', ['as' => 'pages.question', 'uses' => 'AppPagesController@question']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::post("submit","Categories@add");
Route::post("add_product","Products@submit_add");
Route::post("add_security","AppPagesController@submit_add");
Route::post("add_policy","AppPagesController@submit_add_policy");
Route::post("add_question","AppPagesController@submit_add_question");
Route::post("add_terms","AppPagesController@submit_add");
Route::post("update_terms","AppPagesController@submit_update");
Route::post("add_policy","AppPagesController@submit_add_privacy_policy");
Route::post("update_policy","AppPagesController@submit_update_privacy_policy");
Route::post("add_question","AppPagesController@submit_add_question");
Route::post("add_help","AppPagesController@submit_add_help");
Route::post("update_help","AppPagesController@submit_update_help");
