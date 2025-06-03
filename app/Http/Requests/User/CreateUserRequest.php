<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [            // Just validate
            'fname' => ["required", "min:2"],
            'lname'  => ["required", "min:2"],
            'email'  => ["required", "min:2", "email", "unique:users,email"],
            'password'  => ["required", "min:8"],
            'phone_no'  => ["required", "min:2", "unique:users,phone_no"],
            'address'  => ["required", "min:2"],
        ];
    }
}
