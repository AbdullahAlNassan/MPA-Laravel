@extends('layout')

@section('title', $book->title)

@section('content')
  @php
    // Bepaal de cover (upload > url > placeholder)
    $cover = $book->cover_path
      ? asset('storage/'.$book->cover_path)
      : ($book->cover_url ?: 'https://via.placeholder.com/960x1360?text=Book');

    // Check of dit boek in favorieten zit (sessie)
    $favIds = session('favorites', []);
    $isFav  = in_array($book->id, $favIds, true);
  @endphp

  <div class="card" style="max-width:900px; margin:0 auto;">
    <img class="card-cover" src="{{ $cover }}" alt="Cover van {{ $book->title }}">
    <div class="card-body">
      <a class="btn btn-ghost" href="{{ route('books.index') }}">&larr; Terug</a>

      <h2 class="card-title" style="margin-top:.5rem;">{{ $book->title }}</h2>

      <p class="card-meta"><strong>Auteur:</strong> {{ $book->author }}</p>
      <p class="card-meta"><strong>Jaar:</strong> {{ $book->published_year ?? '—' }}</p>
      <p class="card-meta"><strong>Pagina's:</strong> {{ $book->pages ?? '—' }}</p>
      <p class="card-meta"><strong>Prijs:</strong> {{ $book->price_formatted ?? '—' }}</p>
      @if($book->genre)
        <p class="card-meta"><strong>Genre:</strong> {{ $book->genre->name }}</p>
      @endif

      <div class="card-actions" style="margin-top:.75rem; display:flex; gap:.5rem; flex-wrap:wrap;">
        {{-- Favorieten: alleen voor ingelogde gebruikers --}}
        @auth
          @if(!$isFav)
            <form method="POST" action="{{ route('favorites.store', $book) }}">
              @csrf
              <button type="submit" class="btn btn-secondary">⭐ Bewaar als favoriet</button>
            </form>
          @else
            <form method="POST" action="{{ route('favorites.destroy', $book) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-ghost">★ Verwijderen uit favorieten</button>
            </form>
          @endif
        @endauth

        {{-- Beheer-acties: alleen voor admin --}}
        @if(auth()->check() && auth()->user()->is_admin)
          <a class="btn btn-secondary" href="{{ route('books.edit', $book) }}">Bewerken</a>
          <form method="POST" action="{{ route('books.destroy', $book) }}"
                onsubmit="return confirm('Weet je zeker dat je dit boek wilt verwijderen?');"
                style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Verwijderen</button>
          </form>
        @endif
      </div>
    </div>
  </div>
@endsection
