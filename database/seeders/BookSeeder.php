<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder   // 👈 beter: enkelvoudig en match met bestandsnaam
{
    public function run(): void
    {
        Book::factory()->count(20)->create();
    }
}
