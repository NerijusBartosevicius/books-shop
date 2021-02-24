<?php

namespace App\Http\Livewire\User\Books;

use App\Models\Book;
use Livewire\Component;

class BookReviewsAverage extends Component
{

    protected $listeners = [
        'review_count_updated' => 'calculateReviewsAverage'
    ];

    public $book;

    public function mount()
    {
        $this->book = Book::withAvg('bookReviews', 'rating')->findOrFail(request('book'));
    }

    public function render()
    {
        return view('livewire.user.books.book-reviews-average');
    }

    public function calculateReviewsAverage()
    {
        $this->book = Book::withAvg('bookReviews', 'rating')->findOrFail($this->book->id);
    }
}
