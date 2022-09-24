<?php

namespace App\Http\Resources;

use App\Models\Gallery;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'quantity' => $this->quantity,
            'gallery' => GalleryResource::collection($this->gallery),
            'harga' => "Rp." . number_format($this->price, 2,',','.'),
            'price' => $this->price,
            'created_at' => $this->created_at->format('d F, Y'),
            'tipe' => $this->type,
            'condition' => $this->condition,
            'brand' => $this->brand,
            'description' => $this->description
        ];
    }
}
