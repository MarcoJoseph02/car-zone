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
            'supplier_id'=> $this->supplier_id,
            'category_id'=>$this->category_id,
            'brand_id'=>$this->category_id,
            'id' => $this->id,
            'model'=>$this->category_id,
            'year'=>$this->category_id,
            'price'=>$this->category_id,
            'description'=>$this->category_id,
            'main_image'=>$this->getFirstMediaUrl('mainImage'),
            'images'=>$this->getMedia('gallery')->map(function ($item) {
                return $item->getFullUrl();
            }),
            
        ];
    }
}
