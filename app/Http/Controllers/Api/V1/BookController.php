<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::forApi()->with(['authors', 'genres'])->paginate(10);
        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = Book::forApi()->findOrFail($id);
        return new BookResource($book->append('description'));
    }
}
