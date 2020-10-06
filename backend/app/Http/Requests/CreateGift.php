<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateGift extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required | max:50',
            'content' => 'required | max:400',
            'user_position' => 'required',
            'image_path' => 'mimes:jpeg,jpg,bmp,png,gif',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'content' => '詳細',
            'user_position' => 'ギフト区分',
            'image_path' => '画像',
        ];
    }

    public function storeImagePath($image_path)
    {
        if ($image_path) {
            return $image_path->storeAs('public/gift_images', now() . '_' . Auth::user()->id . '.jpg');
        } else {
            return null;
        }
    }
}
