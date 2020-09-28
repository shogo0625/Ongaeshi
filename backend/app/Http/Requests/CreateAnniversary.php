<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnniversary extends FormRequest
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
            'description' => 'max:1000',
            'date' => "required | min: {{ date('Y-m-d') }}",
            'reminder' => 'required | min:1',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'description' => '説明',
            'date' => '日付',
            'reminder' => '通知日',
        ];
    }
}
