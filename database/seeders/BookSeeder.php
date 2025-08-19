<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder   // 👈 beter: enkelvoudig en match met bestandsnaam
{
    public function run(): void
    {
        Book::factory()->count(20)->create();

        // Handmatig een boek toevoegen
        Book::create([
            'title'          => 'De Hobbit',
            'author'         => 'J.R.R. Tolkien',
            'pages'          => 310,
            'published_year' => 1937,
        ]);
    }
}
