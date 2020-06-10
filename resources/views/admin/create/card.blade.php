@extends('layouts.app')

@section('title', "Create Card | Admin")

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
@endsection


@section('hero')
<x-hero bg="subtle_prism_indigo" class="blank">
    <x-slot name='h1'>
        Create Card
    </x-slot>
</x-hero>
@endsection

@section('content')

<form method = "POST" action = "{{ route('storeCard') }}">
    @csrf
    
    <input type = "hidden" name = "parent_id" value = "{{ $parent_id ?? '' }}" />
    
    <label for = "icon">Icon</label>
    <input type = "text" name = "icon" placeholder = "icon" value="{{ old('icon') }}"/>
    @error('icon')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "thumbnail">Thumbnail</label>
    <input type = "text" name = "thumbnail" placeholder = "thumbnail" value="{{ old('thumbnail') }}"/>
    @error('thumbnail')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "bg">Background</label>
    <input type = "text" name = "bg" placeholder = "bg" value="{{ old('bg') }}"/>
    @error('bg')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "title">Title</label>
    <input type = "text" name = "title" placeholder = "title" required value="{{ old('title') }}"/>
    @error('title')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "description">Description</label>
    <textarea name = "description" required>{{ old('description') }}</textarea>
    @error('description')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "notes">Notes</label>
    <div class = "editor language-js"></div>
    <input name = "notes" id = "notes" type = "hidden" value="{{ old('notes') }}"/>
    @error('notes')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "tags">Tags</label>
    <textarea name = "tags">{{ old('tags') }}</textarea>
    @error('tags')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "type">Type</label>
    <input type = "text" name = "type" placeholder = "type" required value="{{ old('type') }}"/>
    @error('type')
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
    
    <label for = "permalink">Permalink</label>
    <input type = "text" name = "permalink" placeholder = "permalink" required value="{{ old('permalink') }}"/>
    @error('permalink')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <br />
    
    <button type = "submit">Create</button>
</form>


<script type="module">
    // Code below from https://github.com/antonmedv/codejar/blob/master/index.html
    
    import { CodeJar } from 'https://medv.io/codejar/codejar.js'
    
    const editor = document.querySelector('.editor')
    const highlight = editor => {
        // highlight.js does not trim old tags,
        // let's do it by this hack.
        editor.textContent = editor.textContent
        hljs.highlightBlock(editor)
    }
    const jar = CodeJar(editor, highlight)
    jar.updateCode("{{ old('notes') }}")
    
    var notes = document.getElementById('notes')
    
    // Listen to updates
    jar.onUpdate(code => {
        notes.value = code;
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>

@endsection