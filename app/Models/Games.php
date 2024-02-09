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
    
}
