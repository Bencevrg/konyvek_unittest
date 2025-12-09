@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <h1>➕ Add a new book</h1>

    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data" class="form-card">
        @csrf

        <fieldset>
            <label for="title">📖 Title</label>
            <input type="text" name="title" id="title" required>
        </fieldset>

        <fieldset>
            <label for="author_id">✍️ Author</label>
            <select name="author_id" id="author_id" required>
                @foreach ($writers as $writer)
                    <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <label for="price">💰 Price</label>
            <input type="number" name="price" id="price" required>
        </fieldset>

        <fieldset>
            <label for="genre">🎭 Genre</label>
            <input type="text" name="genre" id="genre">
        </fieldset>

        <fieldset>
            <label for="iban">🏦 ISBN</label>
            <input type="text" name="iban" id="iban">
        </fieldset>

        <fieldset>
            <label for="description">📝 Description</label>
            <textarea name="description" id="description" rows="4"></textarea>
        </fieldset>

        <fieldset>
            <label for="image">📷 Cover photo</label>
            <input type="file" name="image" id="image" accept="image/*">
        </fieldset>

        <button type="submit">Save</button>
    </form>


@endsection