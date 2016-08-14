<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use Auth;
use Log;

class ImageController extends Controller
{
    
    // Upload picture to user directory
    public function upload() {

    	$input = Input::all();
    	$rules = array(
    		'file' => 'image|max:3000',
    	);

    	$validation = Validator::make($input, $rules);

    	if($validation->fails()) {
    		return Response::make($validation->errors->first(), 400);
    	}

    	$file = Input::file('file');
    	$extension = File::extension($file->getClientOriginalName());
    	$directory = public_path() . '\uploads\\' . Auth::user()->id . '\\';
    	$filename = sha1(time().time()).".{$extension}";

    	$upload_state = Input::file('file')->move($directory, $filename);

    	if($upload_state) {
    		return Response::json(["status" => 'success', "filename" => '/uploads/' . Auth::user()->id . '/' . $filename], 200);
    	} else {
    		return Response::json('error', 400);
    	}
    }
}
