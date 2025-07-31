@extends('layout')

@section('title', 'Liedjes')

@section('content')
    <h2>Liedjes Overzicht</h2>
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Artiest</th>
                <th>Duur (seconden)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($songs as $song)
                <tr>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->artist }}</td>
                    <td>{{ $song->duration }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
