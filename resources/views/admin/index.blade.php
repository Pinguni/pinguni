@extends('layouts.app')

@section('title', 'Admin')

@section('hero')
<x-hero bg="subtle_prism_indigo" class="blank">
    @slot('class', 'short')
    <x-slot name='h1'>
        Admin
    </x-slot>
</x-hero>
@endsection

@section('content')

<section class = "box box-button">
    <a href = "{{ route('createCard') }}"><button>Create Card</button></a>
</section>

<section class = "box">
    <form method = "POST" action = "{{ route('redirectCard') }}">
        @csrf
        <input type = "text" name = "id" placeholder = "card id" class = "max-w-sm" required/>
        <button type = "submit" class = "ml-4">Edit Card</button>
    </form>
</section>

@endsection