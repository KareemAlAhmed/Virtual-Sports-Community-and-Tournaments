<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollLeague extends Model
{
    use HasFactory;
    function members(){
        return $this->belongsTo(User::class);
    }
}
