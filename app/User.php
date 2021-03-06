<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use DB;
use Auth;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prename', 'lastname', 'username', 'email', 'password', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments() {
        return $this->hasMany('App\FeedComment');
    }
    
    /*
     * Returns user's notification settings.
     */
    public function notificationSettings() {
        return $this->hasOne('App\NotificationSettings');
    }
    
    /*
     * Returns user's privacy settings.
     */
    public function privacySettings() {
        return $this->hasOne('App\PrivacySettings');
    }

    /**
     * Returns friend requests sent to the user.
     * @return type
     */
    public function friendRequests() {
        return $this->hasMany('App\FriendRequest', 'friend_id');
    }

    /**
     * Returns friend requests send from the user.
     * @return type
     */
    public function myRequests() {
        return $this->hasMany('App\FriendRequest', 'user_id');
    }

    public function friends() {
        return $this->hasMany('App\Friend', 'friend_id');
    }
    
    /**
     * Returns true if the given user is a friend of the current user.
     * @param type $id user id
     * @return boolean true if given user is friend of current user.
     */
    public function isFriend($id) {
        return (DB::table('friends')->where([['user_id', Auth::user()->id],['friend_id', $id]])->count() == 1);        
    }

    public function feeds() {
        return $this->hasMany('App\Feed');
    }

    public function participants() {
        return $this->hasMany('App\Participant');
    }

    public function getFriendStatus($id) {

        if (Auth::user()->id == $id) {
            return ["status" => "That's you Jim!"];
        }

        $status = DB::table('friends')->where([['user_id', Auth::user()->id], ['friend_id', $id]])->get();

        // if friends -> return
        if ($status && $status[0]->id) {
            return ["friends" => true, "status" => "friend", "since" => $status[0]->created];
        }


        $status = DB::table('friend_request')->where([['user_id', Auth::user()->id], ['friend_id', $id]])->orWhere([['user_id', $id], ['friend_id', Auth::user()->id]])->get();

        // if request exists -> return
        if ($status && $status[0]->id) {
            if ($status[0]->user_id == $id) {
                // request has been sent by other user
                return ["friends" => false, "status" => "requested", "requestedByMe" => false, "requestedBy" => $id];
            } else {
                return ["friends" => false, "status" => "requested", "requestedByMe" => true];
            }
        }

        return ["friends" => false, "status" => "guest"];
    }

}
