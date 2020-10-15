<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\Gift;

class LikeController extends Controller
{
    public function store(Gift $gift, Request $request)
    {
        $tab_name = ($request->tab_name) ? $request->tab_name : null;

        Like::create([
            'user_id' => Auth::id(),
            'gift_id' => $gift->id,
        ]);

        if ($tab_name) {
            return redirect('/user/' . $gift->user_id . $tab_name);
        }
        return redirect()->back();
    }

    public function destroy(Gift $gift, Request $request)
    {
        $tab_name = ($request->tab_name) ? $request->tab_name : null;

        $like = Like::where('gift_id', $gift->id)->where('user_id', Auth::id())->first();
        $like->delete();

        if ($tab_name) {
            return redirect('/user/' . $gift->user_id . $tab_name);
        }
        return redirect()->back();
    }
}
