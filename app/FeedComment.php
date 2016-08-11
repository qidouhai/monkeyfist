<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedComment extends Model
{
    

    protected $table = 'feed_comment';

    public $timestamps = false;


    public function feed() {
    	return $this->belongsTo('App\Feed');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

}
