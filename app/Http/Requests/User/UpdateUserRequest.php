<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fname' => ["required" , "min:2"],
            'lname'  => ["required" , "min:2"],
            'email'  => ["required" , "min:8",  "email"],
            'password'  => ["required" , "min:8" ],
            'phone_no'  => ["required" , "min:2"],
            'address'  => ["required" , "min:2"],
        ];
    }
}
