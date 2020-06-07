@extends('layouts.app')

@section('title')
    {{ $card->title }} | Resources
@endsection


@section('hero')
    
    <x-hero :bg="$card->bg" class="blank">
        @slot('article', 'article course-header')
        <x-slot name="h1">
            {{ $card->title }}
        </x-slot>
        <a href = "{{ $card->notes }}">{{ $card->notes }}</a>
        <p>{{ $card->description }}</p>
        
        @guest
        @else
            @if (Auth::user()->role == 'admin')
                <a href = "{{ route('editCard', ['id' => $card->id]) }}"><button>Edit</button></a>
            @endif
        @endguest
    </x-hero>

@endsection