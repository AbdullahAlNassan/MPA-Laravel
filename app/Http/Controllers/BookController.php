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

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'published_year' => ['nullable', 'integer', 'between:1500,2100'],
            'pages' => ['nullable', 'integer', 'min:1', 'max:10000'],
        ]);

        $book = \App\Models\Book::create($data);

        return redirect()
            ->route('books.show', $book)
            ->with('status', 'Boek succesvol toegevoegd!');
    }

    public function show(Book $book) // implicit model binding
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'published_year' => ['nullable', 'integer', 'between:1500,2100'],
            'pages' => ['nullable', 'integer', 'min:1', 'max:10000'],
        ]);

        $book->update($data);

        return redirect()
            ->route('books.show', $book)
            ->with('status', 'Boek bijgewerkt.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('status', 'Boek verwijderd.');
    }
}
