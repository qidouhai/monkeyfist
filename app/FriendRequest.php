<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    
    protected $table = 'friend_request';

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }
    
    public function targetUser() {
        return $this->belongsTo('App\User', 'friend_id');
    }
}
