<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Http\Requests\CreateGift;
use App\Http\Requests\EditGift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::all();

        return view('/gift/index', [
            'gifts' => $gifts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGift $request)
    {
        $path = $request->storeImagePath($request->image_path);

        $gift = new Gift([
            'title' => $request->title,
            'content' => $request->content,
            'user_position' => $request->user_position,
            'image_path' => $path ? basename($path) : null,
            'user_id' => auth()->id(),
        ]);
        $gift->save();
        return redirect('/gift/' . $gift->id)->with([
            'message_success' => "<b>" . $gift->title . "</b> が投稿されました。",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function show(Gift $gift)
    {
        return view('gift.show')->with([
            'gift' => $gift,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function edit(Gift $gift)
    {
        return view('gift.edit')->with([
            'gift' => $gift,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function update(EditGift $request, Gift $gift)
    {
        $path = $request->storeImagePath($request->image_path);

        $gift->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_position' => $request->user_position,
            'image_path' => $path ? basename($path) : null,
            'user_id' => auth()->id(),
        ]);

        return redirect('/gift/' . $gift->id)->with([
            'message_success' => "<b>" . $gift->title . "</b> が更新されました。",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gift $gift)
    {
        $old_name = $gift->title;
        $gift->delete();
        return redirect('/gift')->with([
            'message_success' => "<b>" . $old_name . "</b> が削除されました。"
        ]);
    }
}
