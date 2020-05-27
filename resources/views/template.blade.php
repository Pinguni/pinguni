@extends('layouts.app')

@section('title', 'Search')

@section('hero')
<x-hero bg="subtle_prism_indigo" class="blank">
    @slot('class', 'short')
    <x-slot name='h1'>
        H1
    </x-slot>
    
    pppppp
</x-hero>
@endsection

@section('content')

@endsection


<div class = "card-wrapper">
            <a href = {{ url("/resources/view/$child->id") }}>
                <div class = "card">
                    <div class = "icon-wrapper">
                        {!! App\Icon::get("$child->icon") !!}
                    </div>
                    <div class = "content">
                        <p class = "title">{{ $child->title }}</p>
                        <p class = "description">{{ $child->description }}</p>
                        <div>
                        @if ($child->tags)
                            @foreach (App\Help::tags($child->tags) as $tag)
                                <span>{{ $tag }}</span>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </a>
        </div>