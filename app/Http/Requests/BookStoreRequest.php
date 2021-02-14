<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'title' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|numeric|max:99999',
            'discount' => 'numeric|max:100',
            'genres' => 'required|array',
            'authors' => 'required|array',
            'cover' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000'
        ];
    }
}
