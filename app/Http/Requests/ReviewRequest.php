<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            //
            'title' => 'required|max:50',
            'body' => 'required|max:500',
            // 'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'image' => '画像',
        ];
    }
}
