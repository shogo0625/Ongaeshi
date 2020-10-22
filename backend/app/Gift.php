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

    public function getOrderedGifts()
    {
        return $this->orderBy('created_at', 'DESC')->paginate(20);
    }

    public static function getGiftsForTimeline()
    {
        return Gift::select('gifts.*')
            ->join('user_follow', 'user_follow.follow_id', '=', 'gifts.user_id')
            ->where('user_follow.user_id', auth()->id())
            ->orderBy('gifts.created_at', 'DESC')
            ->paginate(20);
    }
}
