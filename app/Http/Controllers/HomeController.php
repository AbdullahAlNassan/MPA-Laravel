<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks  = Book::latest()->take(6)->get();
        $featuredGenres = Genre::orderBy('name')->take(6)->get();

        return view('home', compact('featuredBooks', 'featuredGenres'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
