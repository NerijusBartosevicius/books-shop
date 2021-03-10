<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'price' => $this->faker->numberBetween(1, 999),
            'discount' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->realText(),
            //'cover' => $this->faker->image(public_path('images/books'), 400, 700, null, false),
            'is_confirmed' => rand(0, 1),
            'user_id' => User::all()->random()->id
        ];
    }
}
