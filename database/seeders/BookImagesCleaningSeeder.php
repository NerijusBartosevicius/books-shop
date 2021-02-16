<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookImagesCleaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagesPath = public_path('images/books/');
        $images = scandir($imagesPath);

        foreach ($images as $image) {
            if (file_exists($imagesPath . $image) && !in_array($image, ['no-cover.png', '.', '..'])) {
                unlink($imagesPath . $image);
            }
        }
    }
}
