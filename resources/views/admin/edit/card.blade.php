@extends('layouts.app')

@section('title', "Edit Card #$card->id | Admin")

@section('head')
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

@section('mainClass', 'full')


@section('content')

<form method = "POST" action = "{{ route('updateCard', ['id' => $card->id]) }}" id = "editCardForm">
    @csrf
    
    <aside class = "sidebar">
        <div class = "box">
            
            <input type = "text" name = "icon" placeholder = "icon" value = "{{ $card->icon }}" />
            @error('icon')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "thumbnail" placeholder = "thumbnail" value = "{{ $card->thumbnail }}" />
            @error('thumbnail')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "bg" placeholder = "bg" value = "{{ $card->bg }}" />
            @error('bg')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "title" placeholder = "title" value = "{{ $card->title }}"  required/>
            @error('title')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <textarea name = "description" required placeholder = "description">{!! $card->description !!}</textarea>
            @error('description')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <textarea name = "tags" placeholder = "tags">{!! $card->tags !!}</textarea>
            @error('tags')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "type" placeholder = "type" value = "{{ $card->type }}"  required/>
            @error('type')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "visibility" placeholder = "visibility" value = "{{ $card->visibility }}"  required/>
            @error('visibility')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            <input type = "text" name = "permalink" placeholder = "permalink" value = "{{ $card->permalink }}"  required/>
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
            <textarea name = "notes" class = "summernote">{!! $card->notes !!}</textarea>
            @error('notes')
                <p role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror

            <br />

            <button type = "submit">Update</button>
        </div>
        
    </section>
</form>


<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

<script>
    //import EditorJS from 'https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest'

    const editor = new EditorJS({
        /**
         * Id of Element that should contain Editor instance
         */
        holder: 'editor'
    });
</script>

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