<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('user') . ',id']
        ];
        if (!is_null($this->get('new_password')) && !is_null($this->get('new_confirm_password'))) {
            $rules = array_merge($rules,
                                 [
                                     'new_password' => ['required', 'string', 'min:8'],
                                     'new_confirm_password' => ['required', 'same:new_password']
                                 ]
            );
        }

        return $rules;
    }
}
