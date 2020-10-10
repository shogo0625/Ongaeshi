<?php

namespace App;

use App\Enums\UserPosition;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function gift_comments()
    {
        return $this->hasMany('App\GiftComment');
    }

    public function likes()
    {
        return $this->has_many('App\Like');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_position', 'image_path', 'user_id',
    ];

    protected $enumCasts = [
        'user_status' => \App\Enums\UserPosition::class,
    ];
}
