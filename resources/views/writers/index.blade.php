@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <h1>Writers</h1>

    <a href="{{ route('writers.create') }}" class="add-btn">Add New Author</a>

    @if(session('success'))
        <p class="alert success">{{ session('success') }}</p>
    @endif

    <div class="writer-list">
        @foreach($writers as $writer)
            <div class="writer-card">
                @if($writer->portrait_path)
                    <img src="{{ asset('storage/' . $writer->portrait_path) }}" 
                        alt="{{ $writer->name }}" 
                        class="writer-image">
                @else
                    <div class="writer-placeholder">No image</div>
                @endif

                <div class="writer-details">
                    <h3>{{ $writer->name }}</h3>
                    <p class="bio">{{ $writer->bio }}</p>
                </div>
            </div>
            <div class="book-actions">
                        <a href="{{ route('writers.edit', $writer->id) }}" class="edit-btn">Edit</a>
                <form action="{{ route('writers.destroy', $writer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
