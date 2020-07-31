@extends('layouts.app')

@section('title', "Create Card | Admin")

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

@section('mainClass', 'full')


@section('content')

<!--
    Sidebar
-->
<form method = "POST" action = "{{ route('storeCard') }}" class = "page">
    @csrf
    
    <aside class = "sidebar">
        <div class = "box">

            <input type = "hidden" name = "parent_id" value = "{{ $parent_id ?? '' }}" />

            <!-- <p class = "menu-1-header">Icon</p> -->
            <input type = "text" name = "icon" placeholder = "icon" value="{{ old('icon') }}"/>
            @error('icon')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Thumbnail</p> -->
            <input type = "text" name = "thumbnail" placeholder = "thumbnail" value="{{ old('thumbnail') }}"/>
            @error('thumbnail')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Background</p> -->
            <input type = "text" name = "bg" placeholder = "bg" value="{{ old('bg') }}"/>
            @error('bg')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Title</p> -->
            <input type = "text" name = "title" placeholder = "title" required value="{{ old('title') }}"/>
            @error('title')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Description</p> -->
            <textarea name = "description" required placeholder = "description">{{ old('description') }}</textarea>
            @error('description')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Tags</p> -->
            <textarea name = "tags" placeholder = "tags">{{ old('tags') }}</textarea>
            @error('tags')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Type</p> -->
            <input type = "text" name = "type" placeholder = "type" required value="{{ old('type') }}"/>
            @error('type')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Visibility</p> -->
            <input type = "text" name = "visibility" placeholder = "visibility" required value="{{ old('visibility') }}"/>
            @error('visibility')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <!-- <p class = "menu-1-header">Permalink</p> -->
            <input type = "text" name = "permalink" placeholder = "permalink" required value="{{ old('permalink') }}"/>
            @error('permalink')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        </div>
    </aside>
    
    
    <section class = "section container-wrap">
        
        <!-- 
            Sidebar whitespace div
        -->
        <div class = "sidebar-whitespace"></div>

        <!-- 
            Notes and Create button
        -->
        <div class = "sidebar-container">
            <p class = "menu-1-header">Notes</p>
            <textarea name = "notes" class = "summernote">{!! old('notes') !!}</textarea>
            @error('notes')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <br />

            <button type = "submit">Create</button>
        </div>
        
    </section>
    
    
</form>


@endsection


@section('scripts')
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 300,
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