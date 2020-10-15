<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserFollowController extends Controller
{
    public function store(User $user, Request $request)
    {
        $user_page_id = ($request->user_page_id) ? $request->user_page_id : '';
        $tab_name = ($request->tab_name) ? $request->tab_name : null;
        \Auth::user()->follow($user->id);

        if ($tab_name) {
            return redirect('/user/' . $user_page_id . $tab_name);
        }
        return back();
    }

    public function destroy(User $user, Request $request)
    {
        $user_page_id = ($request->user_page_id) ? $request->user_page_id : '';
        $tab_name = ($request->tab_name) ? $request->tab_name : null;
        \Auth::user()->unfollow($user->id);

        if ($tab_name) {
            return redirect('/user/' . $user_page_id . $tab_name);
        }
        return back();
    }
}
