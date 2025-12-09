@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <h1>Books</h1>

    <a href="{{ route('books.create') }}" class="add-btn">Add new book</a>
    <form method="GET" action="{{ route('books.index') }}" style="margin:20px 0;">
        <input type="text" name="search" placeholder="Search books..." 
               value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
    
    <form method="GET" action="{{ route('books.index') }}" style="margin:20px 0;">
    <label for="author_id">Filter by Author:</label>
    <select name="author_id" id="author_id" onchange="this.form.submit()">
        <option value="">-- All authors --</option>
        @foreach($writers as $writer)
            <option value="{{ $writer->id }}" 
                {{ request('author_id') == $writer->id ? 'selected' : '' }}>
                {{ $writer->name }}
            </option>
        @endforeach
    </select>
</form>
<form method="GET" action="{{ route('books.index') }}" style="margin:20px 0;">
    <label for="genre">Filter by Genre:</label>
    <select name="genre" id="genre" onchange="this.form.submit()">
        <option value="">-- All genres --</option>
        @foreach($genres as $genre)
            <option value="{{ $genre }}" 
                {{ request('genre') == $genre ? 'selected' : '' }}>
                {{ $genre }}
            </option>
        @endforeach
    </select>
</form>

    @if(session('success'))
        <p class="alert success">{{ session('success') }}</p>
    @endif

    <div class="book-list">
        @foreach($books as $book)
            <div class="book-card">
                @if($book->image_path)
                    <img src="{{ asset('storage/' . $book->image_path) }}" 
                        alt="{{ $book->title }}" 
                        class="book-image">
                @else
                    <div class="book-placeholder">No image</div>
                @endif

                <div class="book-details">
                    <p class="adatok"><strong>Title:</strong> {{ $book->title }}</p>
                    <p class="adatok"><strong>Author:</strong> {{ $book->writer ? $book->writer->name : 'N/A' }}</p>
                    <p class="adatok"><strong>Price:</strong> {{ number_format($book->price, 0, ',', ' ') }} Ft</p>
                    <p class="adatok"><strong>Genre:</strong> {{ $book->genre }}</p>

                                    <div class="book-actions">
                        <a href="{{ route('books.edit', $book->id) }}" class="edit-btn">Edit</a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
