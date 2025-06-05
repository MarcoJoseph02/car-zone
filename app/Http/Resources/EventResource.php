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
            'event_name' => $this->event_name,
            // 'image'=> $this->image,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'event_location' => $this->event_location,
            'event_description' => $this->event_description,
            'event_status' => $this->event_status,
            'content' => $this->content,
            'images' => $this->getMedia('event_image')->map(function ($media) {
                return $media->getUrl();
            }),
            'updated_at' => $this->updated_at,
        ];
    }
}
