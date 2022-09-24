<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'photo' => $this->gambar,
            'isDefault' => $this->isDefault == 1 ? 'default' : 'notDefault',
            'description' => $this->description,
            'created_at' => $this->created_at->format('d F, Y')
        ];
    }
}
