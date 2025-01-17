<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_id'=>['required'],
            'category_id'=>['required','min:1'],
            'brand_id'=>['required',"min:1"],
            'branch_id'=>['required',"min:1"],
            'model'=>['required'],
            'year'=>['required'],
            'price'=>['required',"min:1"],
            'description'=>['required'],
        ];
    }
}
