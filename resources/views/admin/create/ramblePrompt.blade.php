@extends('layouts.app')

@section('title', "Create Journalling Prompt | Admin")

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
@endsection


@section('content')

<form method = "POST" action = "{{ route('storeRamblePrompt') }}">
    @csrf
    
    <div class = "wrap-2">
        <label for = "thumbnail">Thumbnail</label>
        <input type = "text" name = "thumbnail" placeholder = "thumbnail" value="{{ old('thumbnail') }}"/>
        @error('thumbnail')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
        
        <label for = "visibility">Visibility</label>
        <input type = "text" name = "visibility" placeholder = "visibility" required value="{{ old('visibility') }}"/>
        @error('visibility')
            <p role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
    </div>
    
    <label for = "prompt">Prompt</label>
    <textarea name = "prompt" required placeholder = "prompt">{{ old('prompt') }}</textarea>
    @error('prompt')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <br />
    
    <button type = "submit">Create</button>
</form>

@endsection
