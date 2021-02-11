<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::with('authors')->get();
        foreach ($books as $book){
            //print $book->title.'<br>';
            foreach ($book->authors as $author){
                print $author->name.' <br>';
            }
        }
        //dd($books);
        return view('home');
    }
}
