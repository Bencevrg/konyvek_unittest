@extends('layouts.app')

@section('content')

<form action="{{ route('books.update', $books->id) }}" method = "post">
    @csrf
    @method('PATCH')
    <fieldset>
    <label for="author_id">Author</label>
    <select name="author_id" id="author_id" required>
        @foreach($writers as $writer)
            <option value="{{ $writer->id }}" 
                {{ old('author_id', $books->author_id) == $writer->id ? 'selected' : '' }}>
                {{ $writer->name }}
            </option>
        @endforeach
    </select>
</fieldset>
    <fieldset>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $books->title) }}">
    </fieldset>
    <fieldset>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required value="{{ old('price', $books->price) }}">
    </fieldset>
    <fieldset>
        <label for="genre">🎭 Genre</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre', $books->genre) }}">
    </fieldset>
    <fieldset>
        <label for="iban">🏦 IBAN</label>
        <input type="text" name="iban" id="iban" value="{{ old('iban', $books->iban) }}">
    </fieldset>
    <fieldset>
        <label for="description">📝 Description</label>
        <textarea name="description" id="description" rows="4">{{ old('description', $books->description) }}></textarea>
    </fieldset>
    <fieldset>
        <label for="image">📷 Cover image</label>
        <input type="file" name="image" id="image" accept="image/*" value="{{ old('image', $books->imagePath) }}">
    </fieldset>
    <button type="submit">Save</button>
</form>

@endsection