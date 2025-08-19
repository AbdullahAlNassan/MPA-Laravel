@extends('layout')

@section('title', $book->title)

@section('content')
    <a href="{{ route('books.index') }}">&larr; Terug naar overzicht</a>

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
