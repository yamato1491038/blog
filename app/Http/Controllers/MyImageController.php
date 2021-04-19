<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyImage;

class MyImageController extends Controller
{
    function upload(Request $request){
        
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg'
        ]);
        $upload_image = $request->file('image');
        $user_id = $request->input('user_id');

        if($upload_image) {

            $path = $upload_image->store('uploads', "public");
            if($path){
                MyImage::create([
                    "file_name" => $upload_image->getClientOriginalName(),
                    "file_path" => $path,
                    "user_id" => $user_id
                ]);
            }
        }
        return redirect("address/index");
    }
}
