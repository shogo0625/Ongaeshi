<?php

namespace App;

use Carbon\Carbon;
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

    // 通知設定の有無・通知までの時間表示
    public function showRemindTimeForAnniversary()
    {
        if ($this->reminder === null) {
            return "通知未設定";
        } elseif (now()->gt($this->reminder)) {
            return "通知済";
        } elseif (now()->diffInHours($this->reminder) < 24) {
            return now()->diffInHours($this->reminder) . "時間後に通知";
        } else {
            $diff_in_days = now()->diffInDays($this->reminder);
            return $diff_in_days . "日後に通知";
        }
    }

    public static function getAnniversariesDependingOnTime($time)
    {
        $time === 'future' ? $symbol = '>' : $symbol = '<=';

        return Anniversary::select()
            ->where('user_id', auth()->id())
            ->where('date', $symbol, now()->subDays(1)) // 当日のデータが過去分に入ってしまうのを防ぐため-1日
            ->orderBy('date')
            ->get();;
    }
}
