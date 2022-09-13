<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sections\SectionCollection;
use App\Http\Resources\Sections\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::select('id', 'name', 'description')->where('published', true)->get();
        return new SectionCollection($sections);
    }

    public function show(Section $section)
    {
        SectionResource::withoutWrapping();
        return new SectionResource($section);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }



    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request, Section $section)
    {
        //
    }

    public function destroy(Section $section)
    {
        //
    }
}
