@extends('layout')

@section('title', 'Boek bewerken')

@section('content')
    <h2>Boek bewerken</h2>

    @if (session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Titel *</label><br>
            <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}">
            @error('title') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="author">Auteur *</label><br>
            <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}">
            @error('author') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="published_year">Jaar</label><br>
            <input id="published_year" name="published_year" type="number" value="{{ old('published_year', $book->published_year) }}">
            @error('published_year') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="pages">Pagina's</label><br>
            <input id="pages" name="pages" type="number" value="{{ old('pages', $book->pages) }}">
            @error('pages') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Opslaan</button>
        <a href="{{ route('books.show', $book) }}">Annuleren</a>
    </form>
@endsection
