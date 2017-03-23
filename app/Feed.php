<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

    public function comments() {
        return $this->hasMany(FeedComment::class);
    }

    public function likes() {
    	return $this->hasOne(Like::class)->selectRaw('feed_id, count(*) as count')->where('like', 1)->groupBy('feed_id');
    }

    public function dislikes() {
    	return $this->hasOne(Like::class)->selectRaw('feed_id, count(*) as count')->where('like', 0)->groupBy('feed_id');
    }

    public function votes() {
    	return $this->hasMany(Like::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
