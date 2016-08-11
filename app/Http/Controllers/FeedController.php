<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\FeedComment;
use App\Feed;

class FeedController extends Controller
{
    //

    protected function index() {
    	$feeds = Feed::with('user', 'comments.user')->get();
    	return $feeds;
    }

    protected function get($skip, $take) {
    	$user = Auth::user();
        $feeds = Feed::with('user', 'comments.user')->where('user_id', $user->id)->skip($skip)->take($take)->get();

    	return $feeds;
    }

    public function store(Request $request) {

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
}
