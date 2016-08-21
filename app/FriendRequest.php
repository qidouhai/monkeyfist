<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    
    protected $table = 'friend_request';

    public function user() {
    	return $this->belongsTo('App\User');
    } 
}
