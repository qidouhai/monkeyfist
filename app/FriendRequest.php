<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $table = 'friend_request';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function targetUser() {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
