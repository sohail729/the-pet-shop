<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_uuid ' => 'required|sometimes',
            'title' => 'required|sometimes',
            'price' => 'required|sometimes',
            'description' => 'required|sometimes',
            'image' => 'required|sometimes',
            'brand' => 'required|sometimes'
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'category_uuid ' => 'category'
        ];
        
        return $attributes;

    }
}
