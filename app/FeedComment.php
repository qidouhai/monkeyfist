<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedComment extends Model
{
    protected $table = 'feed_comments';

    public function feed() {
        return $this->belongsTo(Feed::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
