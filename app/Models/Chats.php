<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;
    protected $with=["owner","withUser"];
    function owner(){
        return $this->belongsTo(User::class,"ownerId");
    }
    function withUser(){
        return $this->belongsTo(User::class,"withUserId");
    }
}
