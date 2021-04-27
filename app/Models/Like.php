<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use kanazaca\CounterCache\CounterCache;

class Like extends Model
{
    // use CounterCache;

    // public $counterCacheOptions = [
    //     'Address' => [
    //         'field' => 'likes_count',
    //         'foreignKey' => 'address_id'
    //     ]
    // ];

    protected $fillable = ["user_id", "address_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

}