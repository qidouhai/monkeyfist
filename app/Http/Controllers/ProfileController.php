<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\User;
use Auth;

class ProfileController extends Controller
{
    //

    protected function profile($id) {
    	if(Auth::user()->id == $id) {
    		return ["user" => Auth::user(), "self" => true];
    	} else {
    		$user = new User;
    		$friend_status = $user->getFriendStatus($id);
    		return ["user" => User::find($id), "self" => false, "relation" => $friend_status];
    	}
    }
}
