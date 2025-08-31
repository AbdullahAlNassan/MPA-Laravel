@extends('layout')

@section('title', 'Nieuw boek')

@section('content')
  <h2>Nieuw boek</h2>

  <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
      @csrf
      @include('books._form')
      <button type="submit">Opslaan</button>
      <a href="{{ route('books.index') }}">Annuleren</a>
  </form>
@endsection

