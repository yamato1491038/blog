<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Group;


class GroupController extends Controller
{
    public function create(){

        return view('group.create');
    }
}
