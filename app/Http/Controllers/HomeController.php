<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::latest()->where(['is_confirmed' => 1])->paginate(25);
        return view('user.books.index', compact('books'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->bookReviews()->paginate(10);
        return view('user.books.view', compact('book', 'reviews'));
    }
}
