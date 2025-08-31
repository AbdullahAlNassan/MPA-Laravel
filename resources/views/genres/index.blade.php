
@extends('layout')

@section('title', 'Genres')

@section('content')
  <h2>Genres</h2>

  @if($genres->count() >= 5)
    <ul>
      @foreach($genres as $genre)
        <li>
          {{-- Linkt naar de books-lijst gefilterd op dit genre --}}
          <a href="{{ url('/books') }}?genre={{ $genre->id }}">{{ $genre->name }}</a>
        </li>
      @endforeach
    </ul>
  @else
    <p>Voeg eerst meer genres toe via je seeder.</p>
  @endif
@endsection
