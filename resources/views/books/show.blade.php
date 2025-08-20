@extends('layout')

@section('title', $book->title)

@section('content')
    <a href="{{ route('books.index') }}">&larr; Terug naar overzicht</a>
    
    <a href="{{ route('books.edit', $book) }}">Bewerken</a>

    <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline"
          onsubmit="return confirm('Weet je zeker dat je dit boek wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit">Verwijderen</button>
    </form>

    <h2>{{ $book->title }}</h2>

    <dl>
        <dt>Auteur</dt>
        <dd>{{ $book->author }}</dd>

        <dt>Jaar</dt>
        <dd>{{ $book->published_year ?? '—' }}</dd>

        <dt>Pagina's</dt>
        <dd>{{ $book->pages ?? '—' }}</dd>
    </dl>
@endsection
