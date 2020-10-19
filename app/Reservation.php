<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
