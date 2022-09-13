<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\JsonResource;

class BookAuthorRelationResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'country_of_birth'  => $this->country_of_birth,
            'comments'          => $this->comments,
        ];
    }
}
