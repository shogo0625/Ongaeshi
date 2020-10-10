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
        Like::create([
            'user_id' => Auth::id(),
            'gift_id' => $gift->id,
        ]);

        return redirect()->back();
    }

    public function destroy(Gift $gift)
    {
        $like = Like::where('gift_id', $gift->id)->where('user_id', Auth::id())->first();
        $like->delete();

        return redirect()->back();
    }
}
