<?php

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
    if(Auth::user())
        return redirect('/dashboard');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', function() {
		return view('dashboard', ['user' => Auth::user()]);
	});
	Route::get('/profile', function() {
		return view('profile', ['user' => Auth::user()]);
	});


	Route::get('/api/user', function() {
		return Auth::user();
	});

	Route::get('/api/feeds/skip/{skip}/take/{take}', 'FeedController@getFeeds');

	Route::post('/api/feeds', 'FeedController@store');
	Route::post('/api/feeds/{id}/like', 'LikeController@addLike');
	Route::post('/api/feeds/{id}/unlike', 'LikeController@removeLike');
	Route::post('/api/feeds/{id}/dislike', 'LikeController@addDislike');
	Route::post('/api/feeds/{id}/undislike', 'LikeController@removeDislike');

	Route::post('/api/feeds/{feedId}/comment', 'FeedController@storeComment');

});