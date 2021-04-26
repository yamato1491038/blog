<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    // public function scopeSearch($group_id) {

    //     $count = Address::where('group_id', $group_id)->count();
    //     return $count;
    // }
}
