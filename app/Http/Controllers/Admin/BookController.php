<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function confirmBook(Request $request, $id)
    {
        $book = Book::find($id);
        $book->is_confirmed = !$book->is_confirmed;
        $book->save();

        return redirect()->back()->with('success', 'Successfully changed status the book!');
    }
}
