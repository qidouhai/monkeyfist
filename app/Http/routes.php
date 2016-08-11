<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $user = Auth::user();
	return view('layouts.internal', ['user' => $user]);
})->middleware('auth');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', function() {
	$user = Auth::user();
	return view('layouts.internal', ['user' => $user]);
})->middleware('auth');

// API requests
Route::get('/feeds', 'FeedController@index')->middleware('auth');
Route::get('/feeds/skip/{skip}/take/{take}', 'FeedController@get')->middleware('auth');
Route::post('/feed/{id}/comment', 'FeedController@storeComment')->middleware('auth');
Route::get('/search/{query}', 'SearchController@search')->middleware('auth');
