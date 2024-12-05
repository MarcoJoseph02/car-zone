<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' =>["required"],
            'order_date'=>["required"],
            'total_amount' =>["required"],
            'user_id' =>["required","integer"],
            'car_id' =>["required","integer"],
        ];
    }
}
