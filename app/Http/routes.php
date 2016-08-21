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

// Route::get('/feed/{id}', function() {
// 	$user = Auth::user();
// 	return view('layouts.internal', ['user' => $user]);
// })->middleware('auth');

// Route::get('/profile/{id}', 'ProfileController@profile')->middleware('auth');

// API requests
Route::get('/feeds', 'FeedController@index')->middleware('auth');
Route::get('/feeds/{id}', 'FeedController@getById')->middleware('auth');
Route::get('/feeds/skip/{skip}/take/{take}', 'FeedController@get')->middleware('auth');

Route::get('/user', function() { return Auth::user(); })->middleware('auth');
Route::get('/user/{id}/feeds', 'ProfileController@getFeeds')->middleware('auth');
Route::get('/user/{id}/feeds/skip/{skip}/take/{take}', 'ProfileController@takeFeeds')->middleware('auth');
Route::get('/user/friends', 'ProfileController@getFriends')->middleware('auth');
// FOR FUCKS SAKE REMOVE THE IDS IN THE URLS, ELSE EVERYBODY WILL SEE EVERYONES STUFF!!!!

Route::get('/search/{query}', 'SearchController@search')->middleware('auth');

Route::get('/friend/{id}', 'ProfileController@profile')->middleware('auth');



Route::post('/feed', 'FeedController@store')->middleware('auth');
Route::post('/feed/{id}/comment', 'FeedController@storeComment')->middleware('auth');
Route::post('/feed/images', 'ImageController@upload')->middleware('auth');

Route::post('/user/friends/request/{id}', 'ProfileController@addFriendRequest')->middleware('auth');
Route::post('/user/friends/{id}', 'ProfileController@addFriend')->middleware('auth');



Route::delete('/feed/{id}', 'FeedController@delete')->middleware('auth');




Route::any('{path?}', function() {
	$user = Auth::user();
	return view('layouts.internal', ["user" => $user]);
})->where("path", ".+")->middleware("auth");
