<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Address;

class LikeController extends Controller
{
    public function store(Request $request){
        
        // ajax用
        $new_like = new Like;

        $new_like->user_id = Auth::user()->id;
        $new_like->address_id = $request->address_id;
        $new_like->save();

        return response()->json(["new_like"=> $new_like]);
    }


    public function destroy(Request $request){

        // ajax用
        $like_id = $request->like_id;
        Like::find($like_id)->delete();

    }
}
