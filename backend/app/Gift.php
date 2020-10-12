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
        return $this->hasMany('App\Like');
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

    public function is_liked_by($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->count() === 1;
    }

    public function getAllGifts()
    {
        return Gift::select()->orderBy('created_at', 'DESC')->paginate(10);
    }
}
