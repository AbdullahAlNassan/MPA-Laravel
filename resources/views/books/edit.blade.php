@extends('layout')

@section('title', 'Boek bewerken')

@section('content')
  <h2>Boek bewerken</h2>


<form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')  {{-- heel belangrijk voor de juiste route/methode --}}
  
  @include('books._form', ['book' => $book])
  <button type="submit">Opslaan</button>
  <a href="{{ route('books.show', $book) }}">Annuleren</a>
</form>
@endsection
