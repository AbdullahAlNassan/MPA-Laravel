@extends('layout')
@section('title', 'Boeken')

@section('content')
  <div class="card" style="margin-bottom:1rem;">
    <form method="GET" action="{{ url('/books') }}" style="display:flex; gap:.5rem; flex-wrap:wrap; align-items:flex-end;">
      <div>
        <label for="q">Zoek</label><br>
        <input id="q" type="text" name="q" value="{{ $q }}" placeholder="Titel of auteur">
      </div>
      <div>
        <label for="author">Auteur</label><br>
        <input id="author" type="text" name="author" value="{{ $author }}">
      </div>
      <div>
        <label for="year_min">Jaar vanaf</label><br>
        <input id="year_min" type="number" name="year_min" value="{{ $minYr }}">
      </div>
      <div>
        <label for="year_max">Jaar t/m</label><br>
        <input id="year_max" type="number" name="year_max" value="{{ $maxYr }}">
      </div>
      @isset($genres)
      <div>
        <label for="genre">Genre</label><br>
        <select id="genre" name="genre">
          <option value="">— Alle genres —</option>
          @foreach($genres as $g)
            <option value="{{ $g->id }}" {{ (string)$genre === (string)$g->id ? 'selected' : '' }}>
              {{ $g->name }}
            </option>
          @endforeach
        </select>
      </div>
      @endisset
      <div>
        <button type="submit">Filter</button>
        <a class="btn btn-ghost" href="{{ url('/books') }}">Reset</a>
        <a class="btn btn-secondary" href="{{ route('books.create') }}">+ Nieuw boek</a>
        {{-- NEW: Snelkoppeling naar favorieten-overzicht --}}
        <a class="btn btn-ghost" href="{{ route('favorites.index') }}">⭐ Favorieten</a>
      </div>
    </form>
  </div>

  @if($books->count())
    <div class="grid">
      @foreach($books as $book)

        {{-- NEW: bepaal of dit boek al in de favorieten zit (via sessie) --}}
        @php
          $favIds = session('favorites', []);
          $isFav  = in_array($book->id, $favIds, true);
        @endphp

        @php
          $cover = $book->cover_path
            ? asset('storage/'.$book->cover_path)
            : ($book->cover_url ?: 'https://via.placeholder.com/480x680?text=Book');
        @endphp

        <article class="card">
          <img class="card-cover"
               src="{{ $cover }}"
               alt="Cover van {{ $book->title }}">
          <div class="card-body">
            <h3 class="card-title">
              <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
            </h3>

            {{-- NEW: toon genre-naam als die bestaat (optioneel, mooi voor context) --}}
            @if(isset($book->genre) && $book->genre)
              <p class="card-meta">{{ $book->author }} • {{ $book->genre->name }}</p>
            @else
              <p class="card-meta">{{ $book->author }}</p>
            @endif

            <p class="card-meta">
              @if($book->published_year) {{ $book->published_year }} • @endif
              @if($book->pages) {{ $book->pages }} pag. @endif
            </p>

            <div class="card-actions">
              <a class="btn btn-ghost" href="{{ route('books.show', $book) }}">Bekijken</a>

              {{-- CHANGED: beheerknoppen laten staan (jij als beheerder) --}}
              <a class="btn btn-secondary" href="{{ route('books.edit', $book) }}">Bewerken</a>
              <form method="POST" action="{{ route('books.destroy', $book) }}"
                    onsubmit="return confirm('Verwijderen?');" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit">Verwijderen</button>
              </form>

              {{-- NEW: favorieten-knop (toggle op basis van $isFav) --}}
              @if(!$isFav)
                <form method="POST" action="{{ route('favorites.store', $book) }}" style="display:inline">
                  @csrf
                  <button type="submit" class="btn btn-ghost">⭐ Bewaar als favoriet</button>
                </form>
              @else
                <form method="POST" action="{{ route('favorites.destroy', $book) }}" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-ghost">★ Verwijderen uit favorieten</button>
                </form>
              @endif
              {{-- END NEW --}}
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <div style="margin-top:1rem;">
      {{ $books->links() }}
    </div>
  @else
    <div class="card"><p>Geen boeken gevonden.</p></div>
  @endif
@endsection
