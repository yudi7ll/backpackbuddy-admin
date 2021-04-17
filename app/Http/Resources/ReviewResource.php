<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'name' => $this->customer->name,
            'username' => $this->customer->username,
            'content' => $this->content,
            'rating' => $this->rating,
            'is_edited' => $this->created_at != $this->updated_at,
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
