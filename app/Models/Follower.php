<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $with=["usersFollowed","usersFollowing"];
    function usersFollowed(){
        return $this->belongsTo(User::class,"followed_id");
    }
    function usersFollowing(){
        return $this->belongsTo(User::class,"follower_id");
    }
}
