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
            'date' => "required",
            'reminder' => [
                'required', 'min: 0',
                function ($attributes, $value, $fail) {
                    $inputData = $this->all();
                    $remindTime = $this->getRemindTime($inputData['date'], $inputData['reminder'], $inputData['unit']);
                    if ($remindTime <= date('Y-m-d H:m:s')) {
                        $fail('リマインド希望日は現在時刻より後の時間にしてください。');
                    }
                }
            ],
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

    public function getRemindTime($anniversary, $reminder, $unit)
    {
        return $unit === 'hours' ? date('Y-m-d H:m:s', strtotime($anniversary . "-${reminder} hour")) : date('Y-m-d H:m:s', strtotime($anniversary . "-${reminder} day"));
    }
}
