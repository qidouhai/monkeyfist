<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\FeedComment;
use App\FeedLike;
use App\Feed;
use Log;

class FeedController extends Controller
{
    //

    protected function index() {
    	$feeds = Feed::with('user', 'comments.user')->get();
    	return $feeds;
    }

    protected function get($skip, $take) {
    	$user = Auth::user();

      $feeds = Feed::with('user', 'comments.user', 'commentCount', 'likes', 'dislikes')->where('user_id', $user->id)->orderBy('id', 'desc')->skip($skip)->take($take)->get();

    	return $feeds;
    }

    protected function getById($id) {
        $feed = Feed::with('user', 'comments.user')->where('id', $id)->orderBy('id', 'desc')->get();

        return $feed;
    }

    public function store(Request $request) {
        $feed = new Feed;

        $feed->created = $request->created;
        $feed->user_id = Auth::user()->id;
        $feed->content = $request->content;

        if($feed->save()) {
            $feed->user = $feed->user;
            $feed->comments = $feed->comments;
            return $feed;
        }
    }

    public function storeComment(Request $request, $id) {
        $comment = new FeedComment;

        $comment->created = $request->created;
        $comment->user_id = Auth::user()->id;
        $comment->feed_id = $request->feed_id;
        $comment->content = $request->content;

        if($comment->save()){
            $comment->user = $comment->user;
            return $comment;
        }
    }

    public function addLike($id) {
      $like = new FeedLike;

      $status = FeedLike::where([['feed_id', $id], ['user_id', Auth::user()->id]])->get();

      if($status->count() == 0) {
        $like->user_id = Auth::user()->id;
        $like->feed_id = $id;
        $like->like = 1;

        if($like->save()) {
          return $like;
        }
      }
    }

    public function removeLike($id) {
      $status = FeedLike::where([['feed_id', $id],['user_id', Auth::user()->id], ['like', 1]])->delete();
      return $status;
    }

    public function addDislike($id) {
      $dislike = new FeedLike;

      $status = FeedLike::where([['feed_id', $id], ['user_id', Auth::user()->id]])->get();

      if($status->count() == 0) {
        $dislike->user_id = Auth::user()->id;
        $dislike->feed_id = $id;
        $dislike->like = 0;

        if($dislike->save()) {
          return $dislike;
        }
      }
    }

    public function removeDislike($id) {
      $status = FeedLike::where([['feed_id', $id],['user_id', Auth::user()->id], ['like', 0]])->delete();
      return $status;
    }

    public function delete($id) {
        $status = Feed::where([['id', $id],['user_id', Auth::user()->id]])->delete();
        Log::info($status);
        return $status;
    }
}
