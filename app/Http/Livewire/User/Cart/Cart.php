<?php

namespace App\Http\Livewire\User\Cart;

use App\Facades\Cart as CartFacade;
use Livewire\Component;

class Cart extends Component
{
    public $bookId;

    public function render()
    {
        $books = collect(CartFacade::get()['books']);

        return view('livewire.user.cart.cart', compact('books'));
    }

    public function remove($bookId)
    {
        CartFacade::remove($bookId);
        $this->emit('removeFromCart');
    }
}
