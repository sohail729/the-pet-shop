<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UpdateUserRequest extends FormRequest
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
        $updateRules = 'sometimes|required';
        $rules = [
            'first_name' => $updateRules,
            'last_name' => $updateRules,
            'email' => $updateRules.'|string|email:rfc,dns|'.ValidationRule::unique('users')->ignore($this->uuid, 'uuid'),
            'password' => $updateRules.'|string|min:4|confirmed',
            'address' => $updateRules,
            'phone_number' => $updateRules,
            'avatar' => $updateRules,
            'is_marketing' => $updateRules,
        ];

        return $rules;
    }
}
