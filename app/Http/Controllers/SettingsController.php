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
      $user = Auth::user();
      $user->prename = $request->prename;
      $user->lastname = $request->lastname;
      $user->username = $request->prename.' '.$request->lastname;
      $user->save();

      return ["user" => $user];
    }

    protected function setEmail(Request $request) {
      $user = Auth::user();
      $user->email = $request->email;
      $user->save();

      return ["user" => $user];
    }

    protected function setPassword(Request $request) {
      $this->validate(
          $request, ['password' => 'required|min:6|confirmed']
      );
      $credentials = $request->only('password');
      $user = Auth::user();

      $user->password = bcrypt($credentials['password']);
      $user->save();
      return ["user" => $user];
    }
}
