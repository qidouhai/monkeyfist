<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    
    protected $table = 'friend_request';

    public function users() {
    	$this->belongsTo('App\User');
    } 
}
