<?php

namespace App\Http\Resources\Sections;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'description' => (string)$this->description,

            'links' => [
                'show' => route('api.sections.show', $this->id),
            ],
        ];
    }
}
