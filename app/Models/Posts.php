<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $with=['user',"likes","comments"];
    function user(){
        $user=$this->belongsTo(User::class,'user_id');
        return $user;
    }
    function comments(){   
        return $this->hasMany(Comment::class,'post_id');
    }
    function likes(){
        return $this->hasMany(Like::class,"post_id");
    }
}
