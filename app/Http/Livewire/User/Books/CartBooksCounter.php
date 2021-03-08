<?php

namespace App\Http\Livewire\User\Books;

use App\Facades\Cart;
use Livewire\Component;

class CartBooksCounter extends Component
{
    protected $listeners = [
        'recalculateCartBooksCount' => 'recalculate',
        'removeFromCart' => 'recalculate',
    ];

    public $cartBooksCount = 0;

    public function mount()
    {
        $this->cartBooksCount = Cart::getCount();
    }

    public function render()
    {
        return view('livewire.user.books.cart-books-counter');
    }

    public function recalculate()
    {
        $this->cartBooksCount = Cart::getCount();
    }
}
