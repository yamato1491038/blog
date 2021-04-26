<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Address;
use App\Models\Group;


class GroupController extends Controller
{
    public function create(){

        $groups = Group::all();
        // $groups = Group::select('id','name','count(id)')->groupBy('id')->get()->toArray();
        

        // $groups = DB::table('addresses')
        //     ->select(DB::raw('count(*) as count, group_id'))
        //     // ->where('status', '<>', 1)
        //     ->groupBy('group_id')
        //     ->get();
        // dd($groups);

        // $groups = Group::get()->toArray();

        
        $groups_add_count = array();

        foreach ($groups as $group){
            
            $group_count = Address::where('group_id', $group["id"])->count();
            
            $groups_add_count[$group["id"]] = $group_count;
            // $array1 = array('group_count' => $group_count);

            // $group->concat(['group_count' => $group_count]);
            // array_merge($groups_add_count, $array1);
            
        }

        return view('group.create', [
            'groups' => $groups,
            'groups_add_count' => $groups_add_count
        ]);
    }


    public function store(Request $request){

        $group = new Group;

        $group->name = $request->input('name');
        $group->save();

        return redirect('group/create');
    }

    public function destroy(Request $request){

        $group = Group::find($request->input('id'));
        $group->delete();

        return redirect('group/create');
    }
}
