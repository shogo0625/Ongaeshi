<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function anniversaries()
    {
        return $this->hasMany('App\Anniversary');
    }

    public function gifts()
    {
        return $this->hasMany('App\Gift');
    }

    public function gift_comments()
    {
        return $this->hasMany('App\GiftComment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function followings()
    {
        return $this->belongsToMany('App\User', 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    public function is_following(Int $user_id)
    {
        return $this->followings()->where('follow_id', $user_id)->exists();
    }

    public function follow(Int $user_id)
    {
        $existing = $this->is_following($user_id);
        $myself = $this->id == $user_id;

        if (!$existing && !$myself) {
            $this->followings()->attach($user_id);
        }
    }

    public function unfollow(Int $user_id)
    {
        $existing = $this->is_following($user_id);
        $myself = $this->id == $user_id;

        if ($existing && !$myself) {
            $this->followings()->detach($user_id);
        }
    }

    public function getAllUsers(Int $user_id)
    {
        return $this->where('id', '<>', $user_id)->orderBy('updated_at', 'DESC')->paginate(15);
    }

    public function getOwnGifts(Int $per_page)
    {
        return $this->gifts()->orderBy('created_at', 'DESC')->paginate($per_page);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about_me', 'image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
