<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ["required" , "min:2"],
            'image' =>["nullable" ,"image","mimes:jpeg,png,jpg,gif,svg","max:2048"] ,
        ];
    }
}
