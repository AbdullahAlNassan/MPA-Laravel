@extends('layout')

@section('title', 'Jukebox – Ontdek en beheer je boeken')

@section('content')
  {{-- HERO --}}
  <section class="card" style="padding:2rem; display:grid; grid-template-columns: 1.2fr 0.8fr; gap:1.25rem; align-items:center;">
    <div>
      <h2 style="margin:0 0 .5rem; font-size:2rem;">Alles voor jouw boekencollectie</h2>
      <p style="margin:0 0 1rem; font-size:1.1rem; color:#374151;">
        Jukebox helpt je om boeken te <strong>vinden</strong>, <strong>organiseren</strong> en <strong>bijwerken</strong>.
        Zoek snel, filter op genre of jaar en voeg met één klik nieuwe titels toe — inclusief cover.
      </p>
      <div style="display:flex; gap:.5rem; flex-wrap:wrap;">
        <a class="btn" href="{{ route('books.index') }}">📖 Bekijk boeken</a>
        <a class="btn btn-secondary" href="{{ route('books.create') }}">➕ Nieuw boek toevoegen</a>
      </div>
      <ul style="display:flex; gap:1rem; flex-wrap:wrap; margin:1rem 0 0; padding:0; list-style:none; color:#6b7280; font-size:.95rem;">
        <li>✔️ Snel zoeken & sorteren</li>
        <li>✔️ Covers uploaden</li>
        <li>✔️ Genres & filteren</li>
      </ul>
    </div>
    <div>
      <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1200&auto=format&fit=crop"
           alt="Boekenplank" style="width:100%; border-radius:.9rem;">
    </div>
  </section>

  {{-- USP STRIP --}}
  <section class="grid" style="margin:1rem 0;">
    <div class="card"><h3 class="card-title">Snel & intuïtief</h3><p class="card-meta">Vind in seconden de juiste titel met zoek- en sorteeropties.</p></div>
    <div class="card"><h3 class="card-title">Altijd georganiseerd</h3><p class="card-meta">Beheer auteurs, jaren, pagina’s en genres overzichtelijk.</p></div>
    <div class="card"><h3 class="card-title">Rijke presentatie</h3><p class="card-meta">Voeg covers toe via upload of URL en presenteer alles in cards.</p></div>
  </section>

  {{-- UITGELICHTE GENRES --}}
  <section class="card" style="padding:1rem;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.5rem;">
      <h3 class="card-title" style="margin:0;">Populaire genres</h3>
      <a class="btn btn-ghost" href="{{ route('genres.index') }}">Alle genres →</a>
    </div>
    @if(isset($featuredGenres) && $featuredGenres->count())
      <div class="grid">
        @foreach($featuredGenres as $g)
          <a class="card" href="{{ url('/books') }}?genre={{ $g->id }}" style="padding:1rem; text-decoration:none;">
            <h4 class="card-title" style="margin:0 0 .25rem;">{{ $g->name }}</h4>
            <p class="card-meta">Bekijk boeken in {{ $g->name }}</p>
          </a>
        @endforeach
      </div>
    @else
      <p class="card-meta" style="padding:.5rem 1rem;">Nog geen genres beschikbaar.</p>
    @endif
  </section>

  {{-- UITGELICHTE BOEKEN --}}
  <section class="card" style="padding:1rem;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.5rem;">
      <h3 class="card-title" style="margin:0;">Nieuw toegevoegd</h3>
      <a class="btn btn-ghost" href="{{ route('books.index') }}">Alle boeken →</a>
    </div>

    @if(isset($featuredBooks) && $featuredBooks->count())
      <div class="grid">
        @foreach($featuredBooks as $book)
          @php
            $cover = $book->cover_path
              ? asset('storage/'.$book->cover_path)
              : ($book->cover_url ?: 'https://via.placeholder.com/480x680?text=Book');
          @endphp
          <article class="card">
            <img class="card-cover" src="{{ $cover }}" alt="Cover van {{ $book->title }}">
            <div class="card-body">
              <h4 class="card-title" style="margin:0 0 .25rem;">
                <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
              </h4>
              <p class="card-meta">{{ $book->author }}</p>
              <p class="card-meta">
                @if($book->published_year) {{ $book->published_year }} • @endif
                @if($book->pages) {{ $book->pages }} pag. @endif
              </p>
              <div class="card-actions">
                <a class="btn btn-ghost" href="{{ route('books.show', $book) }}">Bekijken</a>
                <a class="btn btn-secondary" href="{{ route('books.edit', $book) }}">Bewerken</a>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    @else
      <p class="card-meta" style="padding:.5rem 1rem;">Nog geen boeken beschikbaar.</p>
    @endif
  </section>

  {{-- TRUST/OVER --}}
<section class="card" style="padding:1.25rem;">
    <h3 class="card-title">Waarom Abdullah Books?</h3>
    <p class="card-meta" style="margin-bottom:.75rem;">
        Abdullah Books maakt het makkelijk om jouw favoriete boeken snel te vinden, op te slaan en later terug te bekijken.
        Alles overzichtelijk op één plek – altijd en overal toegankelijk.
    </p>
    <ul style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:.5rem; margin:0; padding-left:1.1rem;">
      <li>🔍 Snel je gewenste boek vinden via zoek- en filteropties</li>
      <li>💾 Boeken opslaan en later eenvoudig terugvinden</li>
      <li>📖 Extra informatie per boek zoals auteur, jaar en pagina’s</li>
      <li>🖼️ Voeg een cover toe voor een mooie visuele collectie</li>
    </ul>
</section>
@endsection

