<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{


    private $token;
    public function __construct($resource , $token= null) {
        $this->resource = $resource;
        $this->token = $token;
    }
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
            'name' => $this->fname . " " . $this->lname,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'token' => $this->token,
        ];
    }
}
