<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGift extends CreateGift
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
}