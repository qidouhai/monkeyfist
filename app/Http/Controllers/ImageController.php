<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Imagick;
use Auth;
use Log;

class ImageController extends Controller {

    // Upload picture to user directory
    public function upload() {
        $input = Input::all();
        Log::info($input);
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $extension = File::extension(Input::file('file')->getClientOriginalName());
        $directory = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR;
        $filename = sha1(time() . time());

        $upload_state = Input::file('file')->move($directory, $filename.".{$extension}");
        $this->convertImage($directory,$filename, $extension, false);

        if ($upload_state) {
            return Response::json(["status" => 'success', "image" => DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . $filename .'.'. $extension], 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function uploadProfilePicture() {
        $input = Input::all();
        Log::info($input);
        $rules = array(
            'file' => 'image|max:15000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $extension = File::extension(Input::file('file')->getClientOriginalName());
        $directory = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR;
        $filename = sha1(time() . time());

        $upload_state = Input::file('file')->move($directory, $filename.".{$extension}");
        $this->convertImage($directory,$filename,$extension);

        if ($upload_state) {
            return Response::json(["status" => 'success', "image" => DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . $filename .'.'. $extension,"thumbnail" => DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . $filename .'_thumbnail.png'], 200);
        } else {
            return Response::json('error', 400);
        }
    }
    
    private function convertImage($directory,$filename,$extension,$makeThumbnail=true) {
        $imagick = new Imagick(realpath($directory.$filename.".".$extension));
        $imagick->stripimage();
        $imagick->setimagecompression(Imagick::COMPRESSION_JPEG );
        $imagick->writeImage($directory.$filename.".".$extension);
        
        if($makeThumbnail) {
            $imagick->setimageformat('png8');
            $imagick->setbackgroundcolor('transparent');
            $imagick->thumbnailImage(256, 256, true, true);
            $imagick->writeImage($directory.$filename.'_thumbnail.png');
        }
    }
}
