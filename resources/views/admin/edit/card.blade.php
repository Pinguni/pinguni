@extends('layouts.app')

@section('title', "Edit Card $card->id | Admin")

@section('hero')
<x-hero bg="subtle_prism_indigo" class="blank">
    <x-slot name='h1'>
        Edit Card {{ $card->id }}
    </x-slot>
    {{ $card->title }}
</x-hero>
@endsection

@section('content')

<form method = "POST" action = "{{ route('updateCard', ['id' => $card->id]) }}">
    @csrf
    
    <label for = "icon">Icon</label>
    <input type = "text" name = "icon" placeholder = "icon" value = "{{ $card->icon }}" />
    
    <label for = "thumbnail">Thumbnail</label>
    <input type = "text" name = "thumbnail" placeholder = "thumbnail" value = "{{ $card->thumbnail }}" />
    
    <label for = "bg">Background</label>
    <input type = "text" name = "bg" placeholder = "bg" value = "{{ $card->bg }}" />
    
    <label for = "title">Title</label>
    <input type = "text" name = "title" placeholder = "title" value = "{{ $card->title }}"  required/>
    
    <label for = "description">Description</label>
    <textarea name = "description" required>
        {{ $card->description }}
    </textarea>
    
    
    <label for = "tags">Tags</label>
    <textarea name = "tags">
        {{ $card->tags }}
    </textarea>
    
    <label for = "type">Type</label>
    <input type = "text" name = "type" placeholder = "type" value = "{{ $card->type }}"  required/>
    
    <label for = "visibility">Visibility</label>
    <input type = "text" name = "visibility" placeholder = "visibility" value = "{{ $card->visibility }}"  required/>
    
    <label for = "permalink">Permalink</label>
    <input type = "text" name = "permalink" placeholder = "permalink" value = "{{ $card->permalink }}"  required/>
    
    <br />
    
    <button type = "submit">Update</button>
</form>

<script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    //editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/json");
</script>

@endsection