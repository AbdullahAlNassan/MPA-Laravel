@extends('layout')

@section('title', 'Boeken')

@section('content')
    <h2>Boeken</h2>

    <a href="{{ route('books.create') }}">+ Nieuw boek</a>

    <form method="GET" action="{{ url('/books') }}" style="margin-bottom:1rem;">
        <input type="text" name="q" value="{{ $q }}" placeholder="Zoek op titel of auteur">
        <button type="submit">Zoeken</button>
        @if($q)
            <a href="{{ url('/books') }}">Reset</a>
        @endif
    </form>

    @if($books->count())
        <table>
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Auteur</th>
                    <th>Jaar</th>
                    <th>Pagina's</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></td>
                        <td>
                            <a href="{{ route('books.show', $book) }}">{{ $book->author }}</a>
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book) }}">{{ $book->published_year }}</a>
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book) }}">{{ $book->pages }}</a>
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
