<?php

namespace App\Http\Resources;

use App\Http\Resources\AttributeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'type' => $this->type,
            'attributes' => AttributeResource::collection($this->attributes)->toArray(request()),
            'sections' => SectionResource::collection($this->sections->sortBy('order_column'))->toArray(request())
        ];
    }
}
