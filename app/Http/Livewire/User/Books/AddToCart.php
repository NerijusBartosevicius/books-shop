<?php

namespace App\Http\Livewire\User\Books;

use App\Facades\Cart;
use App\Models\Book;
use Livewire\Component;

class AddToCart extends Component
{
    public $bookId;
    public $in_cart = false;

    public function mount()
    {
        $this->in_cart = Cart::in_cart($this->bookId);
    }

    public function render()
    {
        return view('livewire.user.books.add-to-cart');
    }

    public function addRemoveToCart($bookId)
    {
        if (!$this->in_cart) {
            Cart::add(Book::where('id', $bookId)->first());
        } else {
            Cart::remove($bookId);
        }

        $this->in_cart = Cart::in_cart($bookId);
        $this->emit('recalculateCartBooksCount');
    }
}
