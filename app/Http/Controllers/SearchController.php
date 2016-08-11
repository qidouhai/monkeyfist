<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feed;

class SearchController extends Controller
{
    
    public function search($query) {
    	$feeds = Feed::with('user', 'comments.user')->where('content', 'like', '%' . $query . '%')->get();

    	return ["total_length" => sizeof($feeds), "items" => $feeds];
    }

}
