<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
            ],
            'birthday' => [
                'date',
                'before:today',
                'nullable',
            ],
            'phone' => [
                'max:20',
                'nullable',
            ],
        ];
    }
}
