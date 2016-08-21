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

    protected function addFriendRequest($id) {
        // TODO: if other sent a request already -> make friends, 

        $query = DB::table('friend_request')->insertGetId(['user_id' => Auth::user()->id, 'friend_id' => $id]);
        return $query;
    }

    protected function removeFriendRequest($id) {

    }

    protected function addFriend($id) {

        DB::transaction(function($id) use ($id) {
            $user_id = Auth::user()->id;
            DB::table('friends')->insert([['user_id' => $user_id, 'friend_id' => $id], ['user_id' => $id, 'friend_id' => $user_id]]);

            DB::table('friend_request')->where([['user_id', $user_id], ['friend_id', $id]])->orWhere([['user_id', $id], ['friend_id', $user_id]])->delete();
        });

        // return ["data" => [$id, Auth::user()->id]];
    }

    // returns friends and open friend requests of current user
    protected function getFriends() {
        $requests = User::with('friends.user','friendRequests.user')->where('id', Auth::user()->id)->get();
        return ["requests" => $requests[0]['friendRequests'], "friends" => $requests[0]['friends']];
    }
}