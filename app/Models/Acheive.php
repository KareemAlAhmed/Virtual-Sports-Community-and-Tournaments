<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Acheive extends Model
{
    use HasFactory;
    function users(){      
        return $this->BelongsTo(User::class);
    }
    function acheivement(){
        return $this->BelongsTo(User::class);
    }
}
