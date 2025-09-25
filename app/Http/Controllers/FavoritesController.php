<?php

namespace App\Http\Controllers;

use App\Models\Book;            // We gebruiken Book voor route model binding
use App\Services\Favorites;     // Onze service-klasse

class FavoritesController extends Controller
{
    // Overzicht van favoriete boeken
    public function index(Favorites $favorites)
    {
        // Haal alle favoriete IDs uit de sessie
        $ids = $favorites->all();

        // Laad de echte boeken uit de database op basis van deze IDs
        $books = Book::whereIn('id', $ids)->orderBy('title')->get();

        // Toon de view met de boeken + de teller
        return view('favorites.index', [
            'books' => $books,
            'count' => $favorites->count(),
        ]);
    }

    // Boek toevoegen aan favorieten (POST)
    public function store(Book $book, Favorites $favorites)
    {
        // Voeg het geselecteerde boek toe via de service
        $favorites->add($book->id);

        // Ga terug naar vorige pagina met een succesmelding
        return back()->with('status', 'Boek aan favorieten toegevoegd.');
    }

    // Boek verwijderen uit favorieten (DELETE)
    public function destroy(Book $book, Favorites $favorites)
    {
        // Verwijder dit boek uit de favorieten
        $favorites->remove($book->id);

        // Terug met melding
        return back()->with('status', 'Boek uit favorieten verwijderd.');
    }

    // Alle favorieten leegmaken (POST)
    public function clear(Favorites $favorites)
    {
        // Maak de lijst leeg
        $favorites->clear();

        // Terug met melding
        return back()->with('status', 'Favorieten geleegd.');
    }
}
