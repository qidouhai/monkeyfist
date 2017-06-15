<?php

namespace App\Http\Controllers;

use App\Feed;
use App\FriendRequest;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected function profile($id)
    {
        if (Auth::user()->id == $id) {
            return ["user" => Auth::user(), "self" => true];
        } else {
            $user = new User();
            $friend_status = $user->getFriendStatus($id);
            return ["user" => User::find($id), "self" => false, "relation" => $friend_status];
        }
    }

    /**
     * Returns the feeds of the given user,
     * if current user is authorized to see them.
     * @param Number $id user id
     * @param Number $skip (optional)
     * @param Number $take (optional)
     * @return Feed[]
     */
    protected function getFeeds($id, $skip = 0, $take = 999999)
    {
        $currentUser = Auth::user();
        $givenUser = User::find($id);
        // check if given user is current user
        // or if the given user's feed settings are public
        // of if the given user is a friend of current user
        if ($currentUser->id == $id || $givenUser->privacySettings()->first()->feeds == 'public' || $currentUser->isFriend($id)) {
            $feeds = Feed::with(
                [
                    'user' => function ($query) {
                        $query->select('id', 'username')
                    },
                    'comments.user' => function ($query) {
                        $query->get();
                    },
                    'commentCount' => function ($query) {
                        $query->get();
                    },
                    'likes' => function ($query) {
                        $query->get();
                    },
                    'dislikes' => function ($query) {
                        $query->get();
                    },
                    'votes' => function ($query) {
                        $query->where('user_id', $currentUser->id)->get();
                    }
                ]
            )->where('user_id', $givenUser->id)->orderBy('id', 'desc')->skip($skip)->take($take)->get();
            return $feeds;
        } else {
            return [];
        }
    }


    protected function removeRequest(Request $request)
    {
        $status = FriendRequest::where([['user_id', Auth::user()->id], ['id', $request->id]])->delete();
        if ($status)
            return ['removed' => true, 'id' => $request->id];
    }

    protected function addFriendRequest($id)
    {
        // TODO: if other sent a request already -> make friends
        $query = DB::table('friend_request')->insertGetId(['user_id' => Auth::user()->id, 'friend_id' => $id]);
        return $query;
    }

    protected function answerFriendRequest(Request $request)
    {
        if (strtolower($request->answer) === 'true') {
            $this->addFriend($request->id);
        } else {
            $this->removeFriendRequest($request->id);
        }
    }

    protected function removeFriendRequest($id)
    {
        $user_id = Auth::user()->id;
        $query = DB::table('friend_request')->where([['user_id', $user_id], ['friend_id', $id]])->orWhere([['friend_id', $user_id], ['user_id', id]])->delete();
        return ['status' => 'success', 'user_id' => $id];
    }

    protected function addFriend($id)
    {
        DB::transaction(function ($id) use ($id) {
            $user_id = Auth::user()->id;
            DB::table('friends')->insert([['user_id', $user_id, 'friend_id' => $id], ['user_id' => $id, 'friend_id' => $user_id]]);

            DB::table('friend_request')->where([['user_id' => $user_id], ['friend_id', $id]])->orWhere([['user_id', $id], ['friend_id', $user_id]])->delete();
        });

        return ['friend_id' => $id, 'user_id' => Auth::user()->id];
    }

    protected function removeFriend(Request $request)
    {
        $user_id = Auth::user()->id;
        $query = DB::table('friends')->where([['user_id', $user_id], ['friend_id', $request->id]])->orWhere([['user_id', $request->id], ['friend_id', $user_id]])->delete();
        return ["friend_id" => $request->id, "id" => $user_id];
    }

    /*
     * Returns the friends of the current user.
     * @return type json
     */
    protected function getFriends()
    {

        $f = Auth::user()->with([
            'friends' => function ($query) {
                $query->with([
                    'user' => function ($query) {
                        $query->select('id', 'username', 'picture', 'thumbnail');
                    }
                ]);
            }
        ])->select('id', 'username', 'picture', 'thumbnail')->first();

        return $f;
    }

    // returns friends and open friend requests of current user
    protected function getSocialStatus()
    {

        $requests = User::with([
            'friends' => function ($query) {
                $query->with([
                    'user' => function ($query) {
                        $query->select('id', 'username', 'picture', 'thumbnail');
                    }
                ]);
            },
            'friendRequests' => function ($query) {
                $query->with([
                    'user' => function ($query) {
                        $query->select('id', 'username', 'picture', 'thumbnail');
                    }
                ]);
            },
            'myRequests' => function ($query) {
                $query->with([
                    'targetUser' => function ($query) {
                        $query->select('id', 'username', 'picture', 'thumbnail');
                    }
                ]);
            }
        ])->where('id', Auth::user()->id)->get();
        return ["requests" => $requests[0]['friendRequests'], "myrequests" => $requests[0]['myRequests'], "friends" => $requests[0]['friends']];
    }

    /*
     * Returns the friends of a user.
     * @return type json
     */

    protected function getFriendsOfFriend($id)
    {

        $f = User::with([
            'friends' => function ($query) {
                $query->with([
                    'user' => function ($query) {
                        $query->select('id', 'username', 'picture', 'thumbnail');
                    }
                ]);
            }
        ])->where('id', $id)->select('id', 'username', 'picture', 'thumbnail')->first();

        return $f;
    }
}
