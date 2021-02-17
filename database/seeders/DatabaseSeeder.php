<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([GenresTableSeeder::class, BookImagesCleaningSeeder::class]);
        User::factory(100)->create();
        Author::factory(200)->create();
        Book::factory(100)->create()->each(
            function ($book) {
                $genres = Genre::all()->random(rand(0, 4))->pluck('id');
                $book->genres()->attach($genres);
                $authors = Author::all()->random(rand(0, 4))->pluck('id');
                $book->authors()->attach($authors);
            }
        );
        BookReview::factory(1000)->create();
    }
}
