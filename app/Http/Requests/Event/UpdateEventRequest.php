<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'event_name' => ["required", "string" ,"max:255"],
            // 'image' =>["nullable" ,"image","mimes:jpeg,png,jpg,gif,svg","max:2048"] ,
            'event_date' => ['required', 'date'],
            'event_time' => ['required', 'date_format:H:i'],
            'event_location' =>["required","max:255"] ,
            'event_description' =>["required"] ,
            'event_status' =>["required"] ,
            'content' =>["nullable"] ,
        ];
    }
}
