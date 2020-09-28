<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anniversary extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'date', 'reminder', 'user_id',
    ];
}
