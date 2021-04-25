<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'itinerary_id' => $this->itinerary->id,
            'code' => $this->code,
            'status' => OrderService::toStatusName($this->status),
            'status_code' => $this->status,
            'price' => $this->price,
            'featured_picture' => $this->itinerary->featured_picture,
            'place_name' => $this->itinerary->place_name,
        ];
    }
}
