<?php

namespace App\Http\Resources\Authors;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'books'             => new AuthorBooksRelation($this->whenLoaded('books'))
        ];
    }
}
