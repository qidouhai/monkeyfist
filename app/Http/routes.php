<?php

/*

Route::get('/', function () {
    $user = Auth::user();
})->middleware('auth');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', function() {
})->middleware('auth');

// Route::get('/feed/{id}', function() {
// 	$user = Auth::user();
// 	return view('layouts.internal', ['user' => $user]);
// })->middleware('auth');
Route::get('/user/{id}/feeds', 'ProfileController@getFeeds')->middleware('auth');
Route::get('/user/{id}/feeds/skip/{skip}/take/{take}', 'ProfileController@takeFeeds')->middleware('auth');
Route::get('/user/social', 'ProfileController@getSocialStatus')->middleware('auth');
Route::get('/user/friends', 'ProfileController@getFriends')->middleware('auth');
// in this case it is ok to keep the id in the url
Route::get('/user/{id}/friends', 'ProfileController@getFriendsofFriend')->middleware('auth');
// FOR FUCKS SAKE REMOVE THE IDS IN THE URLS, ELSE EVERYBODY WILL SEE EVERYONES STUFF!!!!

Route::get('/search/{query}', 'SearchController@search')->middleware('auth');

Route::get('/friend/{id}', 'ProfileController@profile')->middleware('auth');

Route::get('/conversation', 'MessengerController@listConversations')->middleware('auth');
Route::get('/conversation/{id}', 'MessengerController@getConversation')->middleware('auth');

Route::get('/settings/notifications', 'SettingsController@getNotificationSettings')->middleware('auth');
Route::get('/settings/privacy', 'SettingsController@getPrivacySettings')->middleware('auth');

Route::post('/feed', 'FeedController@store')->middleware('auth');
Route::post('/feed/{id}/comment', 'FeedController@storeComment')->middleware('auth');
Route::post('/feed/images', 'ImageController@upload')->middleware('auth');
Route::post('/feed/{id}/like', 'FeedController@addLike')->middleware('auth');
Route::post('/feed/{id}/unlike', 'FeedController@removeLike')->middleware('auth');
Route::post('/feed/{id}/dislike', 'FeedController@addDislike')->middleware('auth');
Route::post('/feed/{id}/undislike', 'FeedController@removeDislike')->middleware('auth');

Route::post('/user/friends/request/{id}', 'ProfileController@addFriendRequest')->middleware('auth');
Route::post('/user/friends', 'ProfileController@answerFriendRequest')->middleware('auth');
Route::post('/user/friends/remove', 'ProfileController@removeFriend')->middleware('auth');
Route::post('/user/friends/withdraw', 'ProfileController@removeRequest')->middleware('auth');

Route::post('/conversation', 'MessengerController@createConversation')->middleware('auth');
Route::post('/conversation/search', 'MessengerController@searchConversation')->middleware('auth');
Route::post('/message', 'MessengerController@addMessage')->middleware('auth');

Route::post('/settings/account/names', 'SettingsController@setNames')->middleware('auth');
Route::post('/settings/account/email', 'SettingsController@setEmail')->middleware('auth');
Route::post('/settings/account/password', 'SettingsController@setPassword')->middleware('auth');
Route::post('/settings/notifications', 'SettingsController@setNotificationSettings')->middleware('auth');
Route::post('/settings/privacy', 'SettingsController@setPrivacySettings')->middleware('auth');

Route::delete('/feed/{id}', 'FeedController@delete')->middleware('auth');


Route::any('{path?}', function() {
})->where("path", ".+")->middleware("auth");
