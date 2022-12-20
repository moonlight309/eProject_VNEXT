<?php

namespace App\Http\Requests\User;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class StoreRequest extends FormRequest
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
                'date',
                'before:today',
                'nullable',
            ],
            'role' => [
                'required',
                Rule::in(UserRoleEnum::getArrayView()),
            ],
            'phone' => [
                'max:20',
            ],
            'avatar' => [
                'image',
                'max:2048',
                'nullable',
            ],
            'password' => [
                'required',
                Rules\Password::defaults(),
            ],
            'password_confirmation' => [
                'required',
                'same:password',
            ],
            'email_verified_at' => [
                'nullable',
            ],
        ];
    }
}
