<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'place_name' => 'required | max:50',
            'good_point' => 'required | max:50',
            'body' => 'max:500',
        ];
    }

    public function attributes()
    {
        return [
            'place_name' => '場所名',
            'good_point' => 'グッドポイント',
            'body' => '本文',
        ];
    }
}
