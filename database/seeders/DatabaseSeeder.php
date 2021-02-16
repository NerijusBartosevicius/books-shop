<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(100)->create();
        \App\Models\Author::factory(100)->create();
        \App\Models\Book::factory(10)->create();
    }
}
