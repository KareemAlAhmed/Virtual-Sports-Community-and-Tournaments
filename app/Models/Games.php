<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    
    function leagues(){
        return $this->belongsTo(Leagues::class);
    }
    function tournaments(){
        return $this->belongsTo(Tournaments::class);
    }
    function user1(){
        return $this->belongsTo(User::class,"user_id");
    }
    function user2(){
        return $this->belongsTo(User::class,"user2_id");
    }
    protected $with=['user1','user2','leagues','tournaments'];
}
