<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;

class User extends Authenticatable
{
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

    public function friendRequests() {
        return $this->hasMany('App\FriendRequest');
    }

    public function friends() {
        return $this->belongsToMany('App\Friend');
    }

    public function feeds() {
        return $this->hasMany('App\Feed');
    }

    public function getFriendStatus($id) {

        if(Auth::user()->id == $id) {
            return ["status" => "That's you Jim!"];
        }

        $status = DB::table('friends')->where([['user_id', Auth::user()->id], ['friend_id', $id]])->get();

        // if friends -> return
        if($status && $status[0]->id) {
            return ["friends" => true, "status" => "friend", "since" => $status[0]->created];
        }
        

        $status = DB::table('friend_request')->where([['user_id', Auth::user()->id], ['friend_id', $id]])->orWhere([['user_id', $id], ['friend_id', Auth::user()->id]])->get();

        // if request exists -> return
        if($status && $status[0]->id) {
            if($status[0]->user_id == $id) {
                // request has been sent by other user
                return ["friends" => false, "status" => "requested", "requestedByMe" => false, "requestedBy" => $id];
            } else {
                return ["friends" => false, "status" => "requested", "requestedByMe" => true];
            }
        }

        return ["friends" => false, "status" => "guest"];
    }
}
