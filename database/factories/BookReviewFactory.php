<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'book_id' => Book::where(['is_confirmed' => 1])->get()->random()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'message' => $this->faker->realText(500)
        ];
    }
}
