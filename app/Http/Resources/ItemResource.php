<?php

namespace App\Http\Resources;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = Image::where('item_id', $this->id)->get();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'introduction' => $this->introduction,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => $this->user_id,
            'image' => [
                'main' => $this->image,
                'other_image' => ImageResource::collection($result),
            ],
        ];
    }
}
