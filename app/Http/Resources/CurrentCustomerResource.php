<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'email_verification_at' => $this->email_verification_at,
            'joined_at' => $this->created_at,
        ];
    }
}
