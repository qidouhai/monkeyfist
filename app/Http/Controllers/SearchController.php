<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feed;
use App\User;

class SearchController extends Controller
{
    
    public function search($query) {
    	$feeds = Feed::with('user', 'comments.user')->where('content', 'like', '%' . $query . '%')->get();
    	$users = User::where('username', 'like', '%' . $query . '%')->get();

    	$useritems = ["type" => "user", "children" => $users];
    	$feeditems = ["type" => "feed", "children" => $feeds];

    	$result = [$useritems, $feeditems];

    	return ["total_length" => (sizeof($feeds) + sizeof($users)), "items" => $result];
    }

}
