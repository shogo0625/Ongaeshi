<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAnniversary extends CreateAnniversary
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
        return parent::rules();
    }

    public function attributes()
    {
        return parent::attributes();
    }

    // CreateAnniversary Requestと記述重複 書き方調べる
    public function getRemindTime($anniversary, $reminder, $unit)
    {
        if ($reminder === null) {
            return $reminder;
        }
        return $unit === 'hours' ? date('Y-m-d H:m:s', strtotime($anniversary . "-${reminder} hour")) : date('Y-m-d H:m:s', strtotime($anniversary . "-${reminder} day"));
    }
}
