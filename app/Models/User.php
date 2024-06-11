<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'bio'
    // ];
    protected $guarded=[];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    function posts(){
        return $this->hasMany(Posts::class);
    }

    function acheivements(){
        return $this->hasMany(Acheive::class);
    }
    function winningTourn(){
        return $this->hasMany(Tournaments::class,'winner_id');
    }
    function winningLeague(){
        return $this->hasMany(Leagues::class,'winner_id');
    }
    function leagues(){
        return $this->hasMany(enrollLeague::class);
    }
    function tournaments(){
        return $this->hasMany(enrollTourn::class);
    }
    function gamesAsP1(){
        return $this->hasMany(Games::class,'user_id');
    }
    function gamesAsP2(){
        return $this->hasMany(Games::class,'user2_id');
    }
}
