<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with([
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'about_me' => 'max:400',
            'image_path' => 'mimes:jpeg,jpg,bmp,png,gif',
        ]);

        $original_path = $user->image_path;
        $new_path = $request->image_path ? $request->image_path->storeAs('public/user_images', date('YmdHms') . '_' . auth()->id() . '.jpg') : null;
        if ($new_path === null) {
            $path = $original_path;
        } else {
            $path = $new_path;
            Storage::delete('/public/user_images/' . $original_path);
        }

        $user->update([
            'about_me' => $request->about_me,
            'image_path' => $path ? basename($path) : null,
        ]);

        return redirect('/user/' . $user->id)->with([
            'message_success' => "ユーザープロフィールが更新されました。",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function deleteImages($user_id)
    {
        $user = User::find($user_id);
        if ($user->image_path !== null) {
            Storage::delete('/public/user_images/' . $user->image_path);
            $user->update(['image_path' => null]);
        }

        return back()->with([
            'message_success' => "元の画像はリセットされました。"
        ]);
    }
}
