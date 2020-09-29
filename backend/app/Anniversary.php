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

    protected $dates = ['date', 'reminder'];

    public function showRemindTimeForAnniversary()
    {
        if ($diffInHours = $this->date->diffInHours($this->reminder) < 24) {
            return $diffInHours . "時間後に通知";
        } else {
            $diffInDays = $this->date->diffInDays($this->reminder);
            return $diffInDays . "日後に通知";
        }
    }
}
