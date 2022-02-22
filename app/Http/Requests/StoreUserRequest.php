<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'address' => 'required',
            'phone_number' => 'required',
            'avatar' => 'sometimes|required',
            'is_marketing' => 'sometimes|required',
        ];

        return $rules;
    }
}