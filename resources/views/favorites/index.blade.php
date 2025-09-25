@extends('layout')

@section('title', 'Mijn favorieten')

@section('content')
  <div class="card" style="margin-bottom:1rem;">
    <h2 class="card-title" style="margin:0;">Mijn favorieten ({{ $count }})</h2>
    <p class="card-meta">Sla je favoriete boeken tijdelijk op in je sessie.</p>

    @if($count > 0)
      {{-- Leegmaken-knop (POST naar favorites.clear) --}}
      <form method="POST" action="{{ route('favorites.clear') }}" onsubmit="return confirm('Alle favorieten leegmaken?');">
        @csrf
        <button type="submit" class="btn">Leegmaken</button>
        <a href="{{ route('books.index') }}" class="btn btn-ghost">Verder zoeken</a>
      </form>
    @else
      <a href="{{ route('books.index') }}" class="btn">Boeken bekijken</a>
    @endif
  </div>

  @if($books->count())
    <div class="grid">
      @foreach($books as $book)
        @php
          $cover = $book->cover_path
            ? asset('storage/'.$book->cover_path)
            : ($book->cover_url ?: 'https://via.placeholder.com/480x680?text=Book');
        @endphp

        <article class="card">
          <img class="card-cover" src="{{ $cover }}" alt="Cover van {{ $book->title }}">
          <div class="card-body">
            <h3 class="card-title" style="margin:0 0 .25rem;">
              <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
            </h3>
            <p class="card-meta">{{ $book->author }}</p>

            <div class="card-actions">
              <a class="btn btn-ghost" href="{{ route('books.show', $book) }}">Bekijken</a>

              {{-- Verwijderen uit favorieten --}}
              <form method="POST" action="{{ route('favorites.destroy', $book) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">★ Verwijderen</button>
              </form>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  @else
    <div class="card"><p>Je hebt nog geen favorieten.</p></div>
  @endif
@endsection
