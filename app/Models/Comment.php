<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
   
    function post(){
        return $this->belongsTo(Posts::class,"post_id");
    }
    function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
