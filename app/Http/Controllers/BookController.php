<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q     = $request->input('q');
        $author= $request->input('author');
        $minYr = $request->input('year_min');
        $maxYr = $request->input('year_max');
        $genre  = $request->input('genre');

        // veilige sort-parameters (whitelist)
        $sort  = $request->input('sort', 'title');           // default
        $dir   = $request->input('dir', 'asc');              // default
        $allowCols = ['title','author','published_year','pages'];
        $allowDir  = ['asc','desc'];
        if (!in_array($sort, $allowCols)) $sort = 'title';
        if (!in_array($dir,  $allowDir))  $dir  = 'asc';

        $books = Book::query()
            ->with('genre')
            ->when($q, function ($qbuilder) use ($q) {
                $qbuilder->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('author', 'like', "%{$q}%");
                });
            })
            ->when($author, fn($qb) => $qb->where('author','like',"%{$author}%"))
            ->when($minYr, fn($qb) => $qb->where('published_year','>=',$minYr))
            ->when($maxYr, fn($qb) => $qb->where('published_year','<=',$maxYr))
            ->when($genre, fn($qb) => $qb->where('genre_id', $genre))
            ->orderBy($sort, $dir)
            ->paginate(10)
            ->appends($request->query()); // behoud filters/zoekterm bij paginatie

        $genres = \App\Models\Genre::orderBy('name')->get(['id','name']);

        return view('books.index', compact(
    'books','q','author','minYr','maxYr','sort','dir','genre','genres'
));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => ['required','string','max:255'],
            'author'         => ['required','string','max:255'],
            'published_year' => ['nullable','integer','between:1500,2100'],
            'pages'          => ['nullable','integer','min:1','max:10000'],
            'cover_url'      => ['nullable','url','max:2048'], // nieuw
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
            'title'          => ['required','string','max:255'],
            'author'         => ['required','string','max:255'],
            'published_year' => ['nullable','integer','between:1500,2100'],
            'pages'          => ['nullable','integer','min:1','max:10000'],
            'cover_url'      => ['nullable','url','max:2048'], // nieuw
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
