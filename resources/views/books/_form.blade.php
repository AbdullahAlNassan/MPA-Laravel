{{-- Verwacht: $book (optioneel) --}}
@php
  $isEdit = isset($book);
@endphp

@if ($errors->any())
  <div class="alert-error" style="margin-bottom:1rem;">
    <strong>Er ging iets mis:</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div>
  <label for="title">Titel *</label><br>
  <input id="title" name="title" type="text"
         value="{{ old('title', $isEdit ? $book->title : '') }}">
  @error('title') <div class="field-error">{{ $message }}</div> @enderror
</div>

<div>
  <label for="author">Auteur *</label><br>
  <input id="author" name="author" type="text"
         value="{{ old('author', $isEdit ? $book->author : '') }}">
  @error('author') <div class="field-error">{{ $message }}</div> @enderror
</div>

<div>
  <label for="published_year">Jaar</label><br>
  <input id="published_year" name="published_year" type="number"
         value="{{ old('published_year', $isEdit ? $book->published_year : '') }}">
  @error('published_year') <div class="field-error">{{ $message }}</div> @enderror
</div>

<div>
  <label for="pages">Pagina's</label><br>
  <input id="price" name="price" type="number" step="0.01" min="0"
       value="{{ old('price', $isEdit ? $book->price : '') }}">
  @error('pages') <div class="field-error">{{ $message }}</div> @enderror
</div>

<div>
  <label for="price">Prijs (€)</label><br>
  <input id="price" name="price" type="number" step="0.01" min="0"
         value="{{ old('price', $isEdit ? $book->price : '') }}">
  @error('price') <div class="field-error">{{ $message }}</div> @enderror
</div>


<div>
  <label for="cover_url">Cover URL</label><br>
  <input id="cover_url" name="cover_url" type="text"
         placeholder="https://…/cover.jpg"
         value="{{ old('cover_url', $isEdit ? $book->cover_url : '') }}">
  @error('cover_url') <div class="field-error">{{ $message }}</div> @enderror
</div>

<div>
  <label for="cover_file">Cover upload (jpg/png, optioneel)</label><br>
  <input id="cover_file" name="cover_file" type="file" accept="image/*">
  @error('cover_file') <div class="field-error">{{ $message }}</div> @enderror
</div>
