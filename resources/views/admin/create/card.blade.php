@extends('layouts.app')

@section('title', "Create Card | Admin")

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
    
    <div class = "wrap-3">
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
    </div>
    
    <label for = "title">Title</label>
    <input type = "text" name = "title" placeholder = "title" required value="{{ old('title') }}"/>
    @error('title')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "description">Description</label>
    <textarea name = "description" required placeholder = "description">{{ old('description') }}</textarea>
    @error('description')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "notes">Notes</label>
    <textarea name = "notes" class = "summernote">{!! old('notes') !!}</textarea>
    @error('notes')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <label for = "tags">Tags</label>
    <textarea name = "tags" placeholder = "tags">{{ old('tags') }}</textarea>
    @error('tags')
        <p role="alert">
            <strong>{{ $message }}</strong>
        </p>
    @enderror
    
    <div class = "wrap-3">
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
    </div>
    
    <br />
    
    <button type = "submit">Create</button>
</form>

@endsection


@section('scripts')
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
</script>
@endsection