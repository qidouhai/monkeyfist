<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    

    protected $table = 'feed';


 	public function comments() {
 		return $this->hasMany('App\FeedComment');
 	}

 	public function user() {
 		return $this->belongsTo('App\User');
 	}   
}