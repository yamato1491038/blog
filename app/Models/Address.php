<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'zip_code',
        'prefecture',
        'city',
        'town',
        'phone_number',
        'group_id'
    ];

    public function group(){
        return $this->hasOne(Group::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function like_by(){
        return Like::where('user_id', Auth::user()->id)->first();
    }

    public function scopeSearch($query) {

        $request = request();

        $query->when($request->name, function($q, $name) {
            $q->where('name', 'LIKE', '%' . $name . '%');
        })
        ->when($request->zip_code, function($q, $zip_code) {
            $q->where('zip_code', 'LIKE', '%' . $zip_code . '%');
        })
        ->when($request->prefecture, function($q, $prefecture) {
            $q->where('prefecture', 'LIKE', '%' . $prefecture . '%');
        })
        ->when($request->city, function($q, $city) {
            $q->where('city', 'LIKE', '%' . $city . '%');
        })
        ->when($request->town, function($q, $town) {
            $q->where('town', 'LIKE', '%' . $town . '%');
        })
        ->when($request->phone_number, function($q, $phone_number) {
            $q->where('phone_number', 'LIKE', '%' . $phone_number . '%');
        })
        ->when($request->group_id, function($q, $group_id) {
            $q->where('group_id', 'LIKE', $group_id);
        });

    }
}
