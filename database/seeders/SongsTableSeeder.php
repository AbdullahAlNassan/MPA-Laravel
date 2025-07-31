<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            [
                'title' => 'Bohemian Rhapsody',
                'artist' => 'Queen',
                'duration' => 354,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Shape of You',
                'artist' => 'Ed Sheeran',
                'duration' => 263,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Rolling in the Deep',
                'artist' => 'Adele',
                'duration' => 228,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
