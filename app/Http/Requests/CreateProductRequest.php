<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required', 'max:255', 'min:2', 'unique:products,code,NULL,id,deleted_at,NULL'],
            'name' => ['required', 'min:2', 'max:30'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'color' => ['required'],
            'price' => ['required', 'integer', 'min:0', 'not_in:0'],
            'maker_id' => ['required'],
            'category_id' => ['required']
        ];
    }
}
