<?php

namespace App\Http\Controllers;

use App\GiftComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gift;

class GiftCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Gift $gift, Request $request)
    {
        $request->validate([
            'comment' => 'required | max:200',
        ]);

        $gift_comment = new GiftComment([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'gift_id' => $gift->id,
        ]);
        $gift_comment->save();

        return back()->with([
            'message_success' => 'コメントを投稿しました。'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GiftComment  $giftComment
     * @return \Illuminate\Http\Response
     */
    public function show(GiftComment $giftComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GiftComment  $giftComment
     * @return \Illuminate\Http\Response
     */
    public function edit(GiftComment $giftComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GiftComment  $giftComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiftComment $giftComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GiftComment  $giftComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gift $gift, GiftComment $giftComment)
    {
        $giftComment->delete();

        return back()->with([
            'message_success' => 'コメントを削除しました。'
        ]);
    }
}
