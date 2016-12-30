<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Validator;
use App\Http\Requests;
use App\User;
use Auth;
use App\Feed;

class SettingsController extends Controller {

    protected function setNames(Request $request) {
        $validator = Validator::make($request->all(), [
                    'prename' => 'required|max:255',
                    'lastname' => 'required|max:255'
        ]);

        $user = Auth::user();
        if (!$validator->fails()) {
            $user->prename = $request->prename;
            $user->lastname = $request->lastname;
            $user->username = $request->prename . ' ' . $request->lastname;
            $user->save();
        }

        $message = $validator->fails() ? $validator->errors()->first() : 'Your name has been changed!';
        return ["error" => $validator->fails(), "message" => $message, "user" => $user];
    }

    protected function setEmail(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|max:255|unique:users,email'
        ]);
        $failed = $validator->fails();

        $user = Auth::user();
        if (!$failed) {
            $user->email = $request->email;
            $user->save();
        }

        $message = $failed ? $validator->errors()->first() : 'Your email has been changed!';
        return ["error" => $failed, "message" => $message, "user" => $user];
    }

    protected function setPassword(Request $request) {
        $validator = Validator::make(
                        $request->all(), ['password' => 'required|min:6|confirmed']
        );

        $user = Auth::user();
        if (!$validator->fails()) {
            $credentials = $request->only('password');

            $user->password = bcrypt($credentials['password']);
            $user->save();
        }

        $message = $validator->fails() ? $validator->errors()->first() : 'Your password has been changed!';
        return ["error" => $validator->fails(), "message" => $message, "user" => $user];
    }
    
    protected function setImage(Request $request) {
        $validator = Validator::make($request->all(), ['thumbnailPath' => 'required', 'imagePath' => 'required']);
        
        $user = Auth::user();
        if(!$validator->fails()) {   
            $user->picture = $request->imagePath;
            $user->thumbnail = $request->thumbnailPath;
            $user->save();
        }
        
        $message = $validator->fails() ? $validator->errors()->first() : 'Your profile picture has been set!';
        return ["error" => $validator->fails(), "message" => $message, "user" => $user];
    }
    
    protected function getNotificationSettings() {
        return Auth::user()->notificationSettings()->first();
    }
    
    protected function setNotificationSettings(Request $request) {
        $notificationSettings = Auth::user()->notificationSettings()->first();
        $notificationSettings->message = $request->notifyMessage == 'true' ? 1 : 0;
        $notificationSettings->friend_request = $request->notifyFriendRequest == 'true' ? 1 : 0;
        $notificationSettings->comment = $request->notifyComment == 'true' ? 1 : 0;
        $notificationSettings->feed = $request->notifiyFeed == 'true' ? 1 : 0;
        
        if($notificationSettings->save()) {
            return ["error" => false, "message" => "Your settings have been applied.", "settings" => $notificationSettings];
        } else {
            return ["error" => true, "message" => "Your settings could not be saved.", "settings" => $notificationSettings];
        }
    }
    
    protected function getPrivacySettings() {
        return Auth::user()->privacySettings()->first();
    }
    
    protected function setPrivacySettings(Request $request) {
        $privacySettings = Auth::user()->privacySettings()->first();
        
        $privacySettings->feeds = $request->feeds;
        $privacySettings->collections = $request->collections;
        
        if($privacySettings->save()) {
             return ["error" => false, "message" => "Your settings have been applied.", "settings" => $privacySettings];
        } else {
            return ["error" => true, "message" => "Your settings could not be saved.", "settings" => $privacySettings];
        }
    }

}
