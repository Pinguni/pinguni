@extends('layouts.app')

@section('title', "$user->username")

@section('hero')
<x-hero bg="subtle_prism_indigo" class="blank">
    @slot('class', 'short')
    <x-slot name='h1'>
        {{ $user->username }}
    </x-slot>
    
    <p>{{ $user->tagline }}</p>
    <p>{{ $user->bio }}</p>
</x-hero>
@endsection

@section('content')

<section class = "box">
    <a href="{{ route('logout') }}"
    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <li>{{ __('Logout') }}</li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </a>
</section>

@endsection