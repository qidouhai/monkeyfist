<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

	public function addLike($id) {
		$like = new Like;

		$status = Like::where([['feed_id', $id], ['user_id', Auth::user()->id]])->get();

		if($status->count() == 0) {
			$like->user_id = Auth::user()->id;
			$like->feed_id = $id;
			$like->like = 1;

			if($like->save())
				return $like;
		}
	}

	public function removeLike($id) {
		return Like::where([['feed_id', $id],['user_id', Auth::user()->id],['like', 1]])->delete();
	}

	public function addDislike($id) {
		$dislike = new Like;

		$status = Like::where([['feed_id', $id],['user_id', Auth::user()->id]])->get();

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
		return Like::where([['feed_id', $id],['user_id', Auth::user()->id], ['like', 0]])->delete();
	}
}
