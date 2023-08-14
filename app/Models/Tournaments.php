<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournaments extends Model
{
    use HasFactory;
    function members(){
      return  $this->hasMany(User::class,"user_id");
    }
    function games(){
        return  $this->hasMany(Games::class);
      }
}
