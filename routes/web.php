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
		Route::get('products', ['as' => 'pages.products', 'uses' => 'PageController@products']);
		Route::get('work-us', ['as' => 'pages.work-us', 'uses' => 'PageController@work_us']);
		Route::get('app-pages', ['as' => 'pages.app-pages', 'uses' => 'PageController@app_pages']);
		Route::get('different-parts', ['as' => 'pages.different-parts', 'uses' => 'PageController@different_parts']);
		Route::get('delivery', ['as' => 'pages.delivery', 'uses' => 'PageController@delivery']);
		Route::get('users', ['as' => 'pages.users', 'uses' => 'PageController@users']);
		Route::get('win-with-us', ['as' => 'pages.win-with-us', 'uses' => 'PageController@win_with_us']);
		Route::get('copons', ['as' => 'pages.copons', 'uses' => 'PageController@copons']);
		Route::get('statistics', ['as' => 'pages.statistics', 'uses' => 'PageController@statistics']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

