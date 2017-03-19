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
Route::get('/dashboard', function() {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware('auth');


Route::get('/api/feeds/skip/{skip}/take/{take}', 'FeedController@getFeeds')->middleware('auth');
Route::post('/api/feeds', 'FeedController@store')->middleware('auth');
Route::post('/api/feeds/{feedId}/comment', 'FeedController@storeComment')->middleware('auth');