<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'car_id' => ['required', 'integer', 'exists:cars,id'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'payment_intent_id' => ['required', 'string'],
            'deposit_paid' => ['required', 'boolean'],
            'deposit_charged_at' => ['required', 'date'],
            'status' => ['in:pending_payment,active,cancelled,completed'],
            'cancelled_at' => ['nullable', 'date'],
            'refund_processed' => ['required', 'boolean'],
            'refund_amount' => ['nullable', 'numeric', 'min:0'],
            'maintenance_reminder' => ['nullable', 'date'],
            'maintenance_type' => ['nullable', 'string'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after:starts_at'],

        ];
    }
}
