<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event_name'=> $this->event_name,
            'image'=> $this->image,
            'event_date'=> $this->event_date,
            'event_time'=> $this->event_date,
            'event_location'=> $this->event_date,
            'event_description'=> $this->event_date,
            'event_status'=> $this->event_date,
            'content'=> $this->event_date,
        ];
    }
}
