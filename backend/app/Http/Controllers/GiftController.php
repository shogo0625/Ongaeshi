<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Http\Requests\CreateGift;
use App\Http\Requests\EditGift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Gift $gift)
    {
        $genre = $request->genre;
        $keyword = $request->keyword;

        $query = Gift::query();
        if (!empty($genre)) {
            $query->where('user_position', $genre);
        }
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%");
        }

        if (empty($genre) && empty($keyword)) {
            $gifts = $gift->getOrderedGifts();
        } else {
            $gifts = $query->orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('/gift/index', compact('gifts', 'keyword', 'genre'));
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
        $new_path = $request->storeImagePath($request->image_path);

        $gift = new Gift([
            'title' => $request->title,
            'content' => $request->content,
            'user_position' => $request->user_position,
            'image_path' => $new_path ? basename($new_path) : null,
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
        $original_path = $gift->image_path;
        $new_path = $request->storeImagePath($request->image_path);
        if ($new_path === null) {
            $path = $original_path;
        } else {
            $path = $new_path;
            Storage::delete('/public/gift_images/' . $original_path);
        }

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
        Storage::delete('/public/gift_images/' . $gift->image_path);
        return redirect('/gift')->with([
            'message_success' => "<b>" . $old_name . "</b> が削除されました。"
        ]);
    }

    public function deleteImages($gift_id)
    {
        $gift = Gift::find($gift_id);
        if ($gift->image_path !== null) {
            Storage::delete('/public/gift_images/' . $gift->image_path);
            $gift->update(['image_path' => null]);
        }

        return back()->with([
            'message_success' => "元の画像はリセットされました。"
        ]);
    }
}
