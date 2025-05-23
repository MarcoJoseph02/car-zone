<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_id'=>['required','min:1'],
            'category_id'=>['required','min:1'],
            'brand_id'=>['required','min:1'],
            'model'=>['required'],
            'year'=>['required'],
            'price'=>['required','min:1','numeric'],
            'doors'=>['required','min:1','numeric'],
            'acceleration'=>['required','min:1','numeric'],
            'top_speed'=>['required','min:1','numeric'],
            'fuel_efficiency'=>['required','min:1','numeric'],
            'color'=>['required','min:1'],
            'engine_type'=>['required','min:1'],
            'engine_power'=>['required','min:1'],
            'engine_cylinder'=>['required','min:1'],
            'engine_cubic_capacity_type'=>['required','min:1'],
            'transmission'=>['required','min:1'],

            // 'image'=>['required','min:1'],
            
            'features'=>['required','min:10'],
            'performance'=>['required','min:10'],
            'safety'=>['required','min:10'],
           
        ];
    }
}
