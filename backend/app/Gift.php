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
