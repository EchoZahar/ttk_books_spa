<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Resources\Books\BookCollection;
use App\Http\Resources\Books\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Section;
use App\Service\BooksDataService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with('authorBook')
            ->where('published', true)
            ->paginate(5);
        return new BookCollection($books);
    }

    public function show(Book $book)
    {
        $book = Book::with('authorBook')->where('id', $book->id)->first();
        BookResource::withoutWrapping();
        return new BookResource($book);
    }

    public function store(StoreRequest $request, BooksDataService $service)
    {
        abort_if(!$request->validated(), Response::HTTP_BAD_REQUEST, '400 Bad request');
        $data = $request->validated();
        $service->checkBookStoreData($request->user(), $request->country_of_birth, $request->comments);
        $data['author_id'] = Author::where('name', $request->author)->first()->id;
        $book = Book::create($request->validated());
        if ($request->hasFile('cover')) {
            $book->book_cover = $request->file('cover')->store('public/bookCovers');
            $book->save();
        }

        $book->sections()->attach(rand(1, Section::count())); // later replace
        Log::info('User: ' . $request->user()->email . PHP_EOL . ' store new book, title "' . $book->title . '" !');
        return response(['message' => 'Book stored successfully !', 'book' => $book])->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        //
    }
}
