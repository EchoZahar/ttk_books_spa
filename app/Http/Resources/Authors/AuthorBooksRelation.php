<?php

namespace App\Http\Resources\Authors;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorBooksRelation extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'year'          => $this->year,
            'description'   => $this->description,
            'cover'         => $this->cover,
        ];
    }
}
