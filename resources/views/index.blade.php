@extends('layout')

@section('title', 'Boeken')

@section('content')
    <h2>Boeken Overzicht</h2>
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Auteur</th>
                <th>Pagina&apos;s</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->pages }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
