<?php

namespace App\Http\Livewire\User\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookReviews extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $book;

    public function mount()
    {
        $this->book = Book::findOrFail(request('book'));
    }

    public function render()
    {
        $reviews = $this->book->bookReviews()->with(['user'])->simplePaginate();
        return view('livewire.user.books.book-reviews', compact('reviews'));
    }
}
