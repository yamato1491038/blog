<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyImage extends Model
{
    use HasFactory;

    protected $table = "my_images";
    protected $fillable = ["file_name", "file_path", "user_id"];

    public function user(){
        return $this->hasOne('App\Models\User');
    }

}
