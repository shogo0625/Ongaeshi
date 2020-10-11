<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserFollowController extends Controller
{
    public function store(User $user)
    {
        \Auth::user()->follow($user->id);
        return back();
    }

    public function destroy(User $user)
    {
        \Auth::user()->unfollow($user->id);
        return back();
    }
}
