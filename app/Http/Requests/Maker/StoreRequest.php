<?php

namespace App\Http\Requests\Maker;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                'max:255',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'description' => [
                'required',
                'string',
                'max:255'
            ],
            'logo' => [
                'image',
            ],
        ];
    }
}
