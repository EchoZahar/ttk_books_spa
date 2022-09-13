<?php

namespace App\Http\Resources\Sections;

use App\Models\Section;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SectionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => SectionResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'isSuccess' => true,
            'links'     => [
                'self'  => route('api.sections.index'),
            ]
        ];
    }
}
