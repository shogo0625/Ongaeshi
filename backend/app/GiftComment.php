<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftComment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function gifts()
    {
        return $this->belongsTo('App\Gift');
    }
}
