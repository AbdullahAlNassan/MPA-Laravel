<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Fantasy','Sci-Fi','Non-Fiction','Mystery','Romance'] as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }
    }
}
