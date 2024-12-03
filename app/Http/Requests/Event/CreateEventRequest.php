<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'image' =>["nullable" ,"image","mimes:jpeg,png,jpg,gif,svg","max:2048"] ,
            'event_date' =>["required"] ,
            'event_time' =>["required"] ,
            'event_location' =>["required","max:255"] ,
            'event_description' =>["required"] ,
            'content' =>["nullable"] ,
        ];
    }
}
