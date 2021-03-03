<?php

namespace App\Http\Livewire\User\Books;

use App\Models\Book;
use App\Models\BookReview;
use Livewire\Component;

class BookReviewsAverage extends Component
{

    protected $listeners = [
        'review_count_updated' => 'calculateReviewsAverage'
    ];

    public $bookId;
    public $avgRating;

    public function render()
    {
        return view('livewire.user.books.book-reviews-average');
    }

    public function calculateReviewsAverage()
    {
        $this->avgRating = BookReview::where('book_id', $this->bookId)->avg('rating');
    }
}
