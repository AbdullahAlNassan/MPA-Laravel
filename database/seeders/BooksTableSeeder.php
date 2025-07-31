<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'De Hobbit',
                'author' => 'J.R.R. Tolkien',
                'pages' => 350,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Harry Potter en de Steen der Wijzen',
                'author' => 'J.K. Rowling',
                'pages' => 320,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'De Da Vinci Code',
                'author' => 'Dan Brown',
                'pages' => 454,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Het Achterhuis',
                'author' => 'Anne Frank',
                'pages' => 256,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
