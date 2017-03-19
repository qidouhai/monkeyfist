<?php

namespace App\Http\Controllers;

use App\Feed;
use App\FeedComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{

    protected function getFeeds($skip, $take)
    {
        return Feed::with([
            'user' => function ($query) {
                $query->select('id', 'username');
            },
            'comments.user' => function ($query) {
                $query->get();
            }
        ])->orderBy('id', 'desc')->skip($skip)->take($take)->get();
    }

    public function store(Request $request) {
        $feed = new Feed;

        $feed->user_id = Auth::user()->id;
        $feed->content = $request->content;

        if($feed->save()) {
            $feed->user = $feed->user;
            $feed->comments = $feed->comments;
            return $feed;
        }
    }

    public function storeComment(Request $request) {
        $comment = new FeedComment;

        $comment->user_id = Auth::user()->id;
        $comment->feed_id = $request->feed_id;
        $comment->content = $request->content;

        if($comment->save()) {
            $comment->user = $comment->user;
            return $comment;
        }
    }

    public function delete($id) {
        return Feed::where([['id', $id],['user_id', Auth::user()->id]])->delete();
    }
}
