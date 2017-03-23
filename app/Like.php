<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

	protected $table = 'feed_likes';

	public function feed() {
		return $this->belongsTo(Feed::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
