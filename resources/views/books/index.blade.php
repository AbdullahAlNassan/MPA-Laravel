@extends('layout')

@section('title', 'Boeken')

@php
  // helper om sorteer-links te maken en richting te togglen
  function sort_link($col, $label, $currentSort, $currentDir) {
      $dir = ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
      $qs  = request()->query();
      $qs['sort'] = $col;
      $qs['dir']  = $dir;
      $url = url('/books') . '?' . http_build_query($qs);
      $arrow = $currentSort === $col ? ($currentDir === 'asc' ? '↑' : '↓') : '';
      return '<a href="'.$url.'">'.$label.' '.$arrow.'</a>';
  }
@endphp

@section('content')
  <h2>Boeken</h2>

  <form method="GET" action="{{ url('/books') }}" style="margin-bottom:1rem;">
    <input type="text" name="q"        value="{{ $q }}"         placeholder="Zoek titel/auteur">
    <input type="text" name="author"   value="{{ $author }}"    placeholder="Filter op auteur">
    <input type="number" name="year_min" value="{{ $minYr }}"   placeholder="Jaar vanaf">
    <input type="number" name="year_max" value="{{ $maxYr }}"   placeholder="Jaar t/m">
    <select name="genre">
      <option value="">— Alle genres —</option>
      @foreach($genres as $g)
        <option value="{{ $g->id }}" {{ (string)$genre === (string)$g->id ? 'selected' : '' }}>
          {{ $g->name }}
        </option>
      @endforeach
    </select>
    <button type="submit">Filter</button>
    <a href="{{ url('/books') }}">Reset</a>
  </form>

  @if($books->count())
    <table>
      <thead>
        <tr>
          <th>{!! sort_link('title','Titel',$sort,$dir) !!}</th>
          <th>{!! sort_link('author','Auteur',$sort,$dir) !!}</th>
          <th>{!! sort_link('published_year','Jaar',$sort,$dir) !!}</th>
          <th>{!! sort_link('pages','Pagina\'s',$sort,$dir) !!}</th>
          <th>Genre</th>
          <th>Acties</th>
        </tr>
      </thead>
      <tbody>
        @foreach($books as $book)
          <tr>
            <td><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->published_year ?? '—' }}</td>
            <td>{{ $book->pages ?? '—' }}</td>
            <td>{{ $book->genre->name ?? '—' }}</td>
            <td>
              <a href="{{ route('books.edit', $book) }}">Bewerken</a>
              <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline"
                    onsubmit="return confirm('Verwijderen?');">
                @csrf @method('DELETE')
                <button type="submit">Verwijderen</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div style="margin-top:1rem;">
      {{ $books->links() }}
    </div>
  @else
    <p>Geen boeken gevonden.</p>
  @endif
@endsection
