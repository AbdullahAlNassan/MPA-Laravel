<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $books = Book::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('author', 'like', "%{$q}%");
                });
            })
            ->orderBy('title')
            ->paginate(10)
            ->appends(request()->query());

        return view('books.index', compact('books', 'q'));
    }

    public function show(Book $book) // implicit model binding
    {
        return view('books.show', compact('book'));
    }
}
