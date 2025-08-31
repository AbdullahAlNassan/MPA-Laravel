<table>
  <thead>
    <tr>
      <th>Titel</th>
      <th>Auteur</th>
      <th>Jaar</th>
      <th>Pagina's</th>
      <th>Genre</th>
      <th>Acties</th>
    </tr>
  </thead>
  <tbody>
    @foreach($books as $book)
      <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->published_year }}</td>
        <td>{{ $book->pages }}</td>
        <td>{{ $book->genre ? $book->genre->name : '—' }}</td>
        <td>
          <a href="{{ route('books.show', $book) }}">Bekijk</a>
          <a href="{{ route('books.edit', $book) }}">Bewerk</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>