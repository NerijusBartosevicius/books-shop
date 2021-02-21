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
        $books = Book::with(['authors'])
            ->withAvg('bookReviews','rating')
            ->when(request('search'),function ($query){
                $search = request('search');
                $query->orWhere('title','LIKE',"%{$search}%")
                      ->orWhere('description','LIKE',"%{$search}%")
                      ->orWhereHas('authors',function ($query) use ($search) {
                          $query->where('name','LIKE',"%{$search}%");
                      });
            })
            ->ByRole()
            ->latest()
            ->simplePaginate();
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
        $book = Book::with(['authors','genres'])->withAvg('bookReviews','rating')->findOrFail($id);
        $reviews = $book->bookReviews()->with(['user'])->simplePaginate();
        return view('user.books.show', compact('book', 'reviews'));
    }
}
