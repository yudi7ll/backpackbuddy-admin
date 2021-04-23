<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentCustomerInfoResource extends JsonResource
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
            'name' => $this->customer->name,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'identity' => $this->identity,
            'telp' => $this->telp,
        ];
    }
}
