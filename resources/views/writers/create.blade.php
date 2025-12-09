@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <h1>Add Writer</h1>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('writers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <label for="name">✍️Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </fieldset>

        <fieldset>
            <label for="bio">📝Bio</label>
            <textarea name="bio" id="bio">{{ old('bio') }}</textarea>
        </fieldset>

        <fieldset>
            <label for="portrait">📷Portrait</label>
            <input type="file" name="portrait" id="portrait">
        </fieldset>

        <button type="submit">Save</button>
    </form>

    <a href="{{ route('writers.index') }}">Back to list</a>
@endsection