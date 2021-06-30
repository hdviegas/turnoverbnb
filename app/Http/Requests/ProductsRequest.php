<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'products' => 'required|array',
            'products.*' => 'required|array',
            'products.*.id' => 'integer|nullable',
            'products.*.name' => 'string|required',
            'products.*.price' => 'numeric|required',
            'products.*.qty' => 'integer|required',
        ];
    }
}
