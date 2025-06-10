<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'supplier_id' => $this->supplier_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'branch_id' => $this->branch_id,
            'model' => $this->model,
            'year' => $this->year,
            'user_id' => $this->user_id,
            'is_sold' => $this->is_sold,
            'is_booked' => $this->is_booked,
            'booking_user' =>UserResource::make($this->booking_user?->user),
            'price' => $this->price,
            'doors' => $this->doors,
            'acceleration' => $this->acceleration,
            'top_speed' => $this->top_speed,
            'fuel_efficiency' => $this->fuel_efficiency,
            'color' => $this->color,
            'engine_type' => $this->engine_type,
            'engine_power' => $this->engine_power,
            'engine_cylinder' => $this->engine_cylinder,
            'engine_cubic_capacity_type' => $this->engine_cubic_capacity_type,
            'transmission' => $this->transmission,
            'features' => $this->features,
            'performance' => $this->performance,
            'safety' => $this->safety,
            'is_available' => $this->is_available
            ,
            'main_image' => $this->getFirstMediaUrl('mainImage'),
            'images' => $this->getMedia('gallery')->map(function ($item) {
                return $item->getFullUrl();
            }),

            'deposit_amount' => $this->price/10,

        ];
    }
}
