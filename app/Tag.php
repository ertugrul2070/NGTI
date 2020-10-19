<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
