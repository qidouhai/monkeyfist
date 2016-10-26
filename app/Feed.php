<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

    protected $table = 'feed';

    public $timestamps = false;


 	public function comments() {
 		return $this->hasMany('App\FeedComment');
 	}

  public function commentCount() {
    // use hasOne because only one row shall be returned
    return $this->hasOne('App\FeedComment')->selectRaw('feed_id, count(*) as count')->groupBy('feed_id');
  }

  public function getCommentCountAttribute() {
    if($this->commentCount)
      return $this->commentCount->count;
    return 0;
  }

 	public function user() {
 		return $this->belongsTo('App\User');
 	}

  public function likes() {
    // use hasOne because only one row shall be returned
    return $this->hasOne('App\FeedLike')->selectRaw('feed_id, count(*) as count')->where('like', 1)->groupBy('feed_id');
  }

  public function dislikes() {
    // use hasOne because only one row shall be returned
    return $this->hasOne('App\FeedLike')->selectRaw('feed_id, count(*) as count')->where('like', 0)->groupBy('feed_id');
  }

  public function getLikeCountAttribute() {
    if($this->likes)
      return $this->likes->count;
    return 0;
  }

  public function detDislikeCountAttribute() {
    if($this->dislikes)
      return $this->dislikes->count;
    return 0;
  }
}
