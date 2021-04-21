<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\MyImage;
use App\Models\User;


class MyImageController extends Controller
{
    public function show(){

        $user_id = Auth::id();
        $user_info = User::find($user_id);
        $my_image = MyImage::where('user_id', $user_id)->first();

        return view('my_image.show', [
            'user_info' => $user_info,
            'my_image' => $my_image
        ]);
    }




    public function upload(Request $request){
        
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg'
        ]);
        $upload_image = $request->file('image');
        $user_id = $request->input('user_id');

        $check_image_exist = MyImage::where('user_id', $user_id)->first();

        // 画像がなければ新規登録
        if(empty($check_image_exist)){

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
        }

        // 元々の画像あれば更新
        if(!empty($check_image_exist)){

            if($upload_image) {

                // もともとのpublicにある画像削除
                Storage::delete('/public/' . $check_image_exist->file_path);

                $path = $upload_image->store('uploads', "public");

                if($path){

                    // DBへの書き換え
                    $check_image_exist->file_name = $upload_image->getClientOriginalName();
                    $check_image_exist->file_path = $path;
            
                    $check_image_exist->save();
                }
            }
        }

        return redirect("my_image/show");
    }
}
