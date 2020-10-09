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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'gift_id', 'user_id',
    ];
}
