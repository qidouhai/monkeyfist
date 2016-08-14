<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\User;
use Auth;
use App\Feed;

class ProfileController extends Controller
{
    //

    protected function profile($id) {
    	if(Auth::user()->id == $id) {
    		return ["user" => Auth::user(), "self" => true];
    	} else {
    		$user = new User;
    		$friend_status = $user->getFriendStatus($id);
    		return ["user" => User::find($id), "self" => false, "relation" => $friend_status];
    	}
    }

    protected function getFeeds($id) {
    	$user = User::find($id);
    	$feeds = Feed::with('user', 'comments.user')->where('user_id', $user->id)->orderBy('id', 'desc')->get();

    	return $feeds;
    }

    protected function takeFeeds($id, $skip, $take) {
    	$user = User::find($id);
    	$feeds = Feed::with('user', 'comments.user')->where('user_id', $user->id)->orderBy('id', 'desc')->skip($skip)->take($take)->get();

    	return $feeds;
    }
}