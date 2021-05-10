<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Address;
use App\Models\Group;


class GroupController extends Controller
{
    public function create(){

        $groups = DB::table('groups')
                        ->leftJoin('addresses', 'groups.id', '=', 'addresses.group_id')
                        ->select('groups.id', 'groups.name', DB::raw("count(addresses.group_id) as count"))
                        ->groupBy('groups.id')
                        ->get();

        return view('group.create', [
            'groups' => $groups,
        ]);
    }


    public function store(Request $request){

        $group = new Group;

        $group->name = $request->input('name');
        $group->save();

        return redirect('group/create');
    }


    public function update(Request $request, $id){

        $group = Group::find($id);

        $group->name = $request->input('name');
        $group->save();

        return redirect('group/create');
    }

    public function destroy(Request $request){

        DB::beginTransaction();
        try {
            $group = Group::find($request->input('id'));
            $group->delete();
            DB::commit();

            return redirect('group/create')->with('グループを削除しました');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('group/create')->with('delete' ,'削除できません');
        }




        // DB::transaction(function () use ($request){
        //     $group = Group::find($request->input('id'));
        //     $group->delete();
        // });

        // return redirect('group/create');
    }
}
