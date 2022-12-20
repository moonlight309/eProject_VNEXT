<?php

namespace App\Http\Requests\User;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'birthday' => [
                'required',
                'date',
                'before:today',
            ],
            'role' => [
                'required',
                Rule::in(UserRoleEnum::getArrayView()),
            ],
            'phone' => [
                'required',
                'max:20',
            ],
            'avatar' => [
                'image',
                'max:2048',
                'nullable',
            ],
        ];
    }
}
