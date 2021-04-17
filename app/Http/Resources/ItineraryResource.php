<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItineraryResource extends JsonResource
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
            'id' => $this->id,
            'place_name' => $this->place_name,
            'price' => $this->price,
            'sale' => $this->sale,
            'featured_picture' => $this->featured_picture,
            'featured_picture_thumb' => $this->featured_picture_thumb,
            'view' => $this->view,
            'excerpt' => $this->excerpt,
            'average_rating' => $this->reviews()->pluck('rating')->avg(),
            'description' => $this->description,
            'reviews' => ReviewResource::collection($this->reviews),
            'media' => MediaResource::collection($this->media),
            'categories' => CategoryResource::collection($this->categories),
            'districts' => DistrictResource::collection($this->districts),
        ];
    }
}
