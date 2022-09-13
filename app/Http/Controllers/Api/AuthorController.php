<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Authors\AuthorCollection;
use App\Http\Resources\Authors\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        return new AuthorCollection(Author::paginate(5));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Author $author)
    {
        return new AuthorResource($author->with(['books']));
    }

    public function edit(Author $author)
    {
        //
    }

    public function update(Request $request, Author $author)
    {
        //
    }

    public function destroy(Author $author)
    {
        //
    }
}
