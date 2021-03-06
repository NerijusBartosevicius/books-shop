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

    public $rating = 5;
    public $message;
    public $success = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'message' => 'required',
    ];

    public function render()
    {
        $reviews = $this->book->bookReviews()->with(['user'])->simplePaginate();
        return view('livewire.user.books.book-reviews', compact('reviews'));
    }

    public function store_review()
    {
        $this->validate();
        auth()->user()->bookReviews()->create(
            [
                'rating' => $this->rating,
                'message' => $this->message,
                'book_id' => $this->book->id,
            ]
        );

        $this->reset(['message']);
        $this->success = true;
        $this->emit('review_count_updated');
    }

}
