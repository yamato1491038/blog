<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Group;


class GroupController extends Controller
{
    public function create(){

        $groups = Group::all();
        $addresses = Address::all();

        return view('group.create', [
            'groups' => $groups,
            'addresses' => $addresses
        ]);
    }


    public function store(Request $request){

        $group = new Group;

        $group->name = $request->input('name');
        $group->save();

        return redirect('group/create');
    }
}
