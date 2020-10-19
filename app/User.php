<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\SocialiteServiceProvider;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    function tag()
    {
        return $this->hasMany(Tag::class);
    }

    function resevation()
    {
        return $this->hasMany(Reservation::class);
    }
}
