<?php

namespace App\Helpers;

use App\Models\Book;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null) {
            $this->set($this->empty());
        }
    }

    public function add(Book $book): void
    {
        $this->remove($book->id);
        $cart = $this->get();
        array_push($cart['books'], $book);
        $this->set($cart);
    }

    public function remove(int $bookId): void
    {
        $cart = $this->get();
        $exists = array_search($bookId, array_column($cart['books'], 'id'));
        if ($exists !== false) {
            array_splice($cart['books'], $exists, 1);
        }
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'books' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }

    public function in_cart(int $bookId): bool
    {
        $cart = $this->get();
        $exists = array_search($bookId, array_column($cart['books'], 'id'));
        if ($exists !== false) {
            return true;
        }

        return $exists;
    }

    public function getCount(): int
    {
        return count($this->get()['books']);
    }
}
