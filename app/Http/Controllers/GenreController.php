<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        // minimaal 5 genres zichtbaar (je seeder regelt de data)
        $genres = Genre::orderBy('name')->get();

        return view('genres.index', compact('genres'));
    }
}
