<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_uuid ' => 'required',
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'brand' => 'required'
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
