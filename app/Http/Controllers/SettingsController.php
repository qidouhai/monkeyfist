<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\User;
use Auth;
use App\Feed;

class SettingsController extends Controller
{

    protected function setNames(Request $request) {
      $user = User::find(Auth::user()->id);
      $user->prename = $request->prename;
      $user->lastname = $request->lastname;
      $user->username = $request->prename.' '.$request->lastname;
      $user->save();

      return ["user" => $user];
    }

    protected function setEmail(Request $request) {
      $user = User::find(Auth::user()->id);
      $user->email = $request->email;
      $user->save();

      return ["user" => $user];
    }
}
