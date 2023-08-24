<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollTourn extends Model
{
    use HasFactory;
    function user(){
        return $this->BelongsTo(User::class);
    }
}
