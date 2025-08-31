@extends('layout')

@section('title', $book->title)

@section('content')
  <div class="card" style="max-width:900px; margin:0 auto;">
    <img class="card-cover" src="{{ $book->cover_url ?: 'https://via.placeholder.com/960x1360?text=Book' }}"
         alt="Cover van {{ $book->title }}">
    <div class="card-body">
      <a class="btn btn-ghost" href="{{ route('books.index') }}">&larr; Terug</a>
      <h2 class="card-title" style="margin-top:.5rem;">{{ $book->title }}</h2>
      <p class="card-meta"><strong>Auteur:</strong> {{ $book->author }}</p>
      <p class="card-meta"><strong>Jaar:</strong> {{ $book->published_year ?? '—' }}</p>
      <p class="card-meta"><strong>Pagina's:</strong> {{ $book->pages ?? '—' }}</p>

      <div class="card-actions">
        <a class="btn btn-secondary" href="{{ route('books.edit', $book) }}">Bewerken</a>
        <form method="POST" action="{{ route('books.destroy', $book) }}"
              onsubmit="return confirm('Verwijderen?');" style="display:inline">
          @csrf @method('DELETE')
          <button type="submit">Verwijderen</button>
        </form>
      </div>
    </div>
  </div>
@endsection
