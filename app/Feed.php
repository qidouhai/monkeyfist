<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

    public function comments() {
        return $this->hasMany(FeedComment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
