<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(20)->create();

        // Genre-IDs ophalen
        $genreIds = Genre::pluck('id');
        Book::query()->inRandomOrder()->take(20)->get()->each(function($book) use ($genreIds) {
            $book->genre_id = $genreIds->random();
            $book->save();
        });

        // Handmatig een boek toevoegen
        Book::create([
            'title'          => 'De Hobbit',
            'author'         => 'J.R.R. Tolkien',
            'pages'          => 310,
            'published_year' => 1937,
            'genre_id'       => Genre::where('name','Fantasy')->value('id'),
            'cover_url'      => 'https://via.placeholder.com/240x340?text=De+Hobbit',
        ]);
    }
}
