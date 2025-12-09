@extends('layouts.app')

@section('content')
    <h1>Edit Writer</h1>

    <form action="{{ route('writers.update', $writers->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <fieldset>
            <label for="name">✍️ Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $writers->name) }}" required>
        </fieldset>

        <fieldset>
            <label for="bio">📝 Biography</label>
            <textarea name="bio" id="bio" rows="4">{{ old('bio', $writers->bio) }}</textarea>
        </fieldset>

        <fieldset>
            <label for="portrait">📷 Portrait</label>
            <input type="file" name="portrait" id="portrait" accept="image/*">
            
            @if($writers->portrait_path)
                <div>
                    <p>Current portrait:</p>
                    <img src="{{ asset('storage/' . $writers->portrait_path) }}" 
                         alt="{{ $writers->name }}" 
                         style="width:120px; height:auto;">
                </div>
            @endif
        </fieldset>

        <button type="submit">Save</button>
    </form>
@endsection
