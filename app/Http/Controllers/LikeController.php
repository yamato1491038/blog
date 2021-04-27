<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Address;

class LikeController extends Controller
{
    public function store(Request $request){
        

        Like::create(
            array(
                'user_id' => Auth::user()->id,
                'address_id' => $request->address_id
            )
        );

        // $address = Address::findOrFail($addressId);

        return redirect('address/index');
    }

    public function destroy(Request $request){

        $like_id = $request->like_id;
        Like::find($like_id)->delete();

        // $address = Address::findOrFail($addressId);
        // $address->like_by()->findOrFail($likeID)->delete();

        return redirect('address/index');

    }
}
