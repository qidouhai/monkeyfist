<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feed;
use App\User;

class SearchController extends Controller
{
    /**
     * Returns the search result.
     * Currently users only are returned.
     * (Left the other lines commented out for future reference.)
     * @param type $query
     * @return type items[]
     */
    public function search($query) {
//    	$feeds = Feed::with('user', 'comments.user')->where('content', 'like', '%' . $query . '%')->get();
    	$users = User::where('username', 'like', '%' . $query . '%')->get();

    	$useritems = ["type" => "user", "children" => $users];
//    	$feeditems = ["type" => "feed", "children" => $feeds];

//    	$result = [$useritems, $feeditems];
        $result = [$useritems];

//    	return ["total_length" => (sizeof($feeds) + sizeof($users)), "items" => $result];
        return ["total_length" => (count($users)), "items" => $result];
    }

}
