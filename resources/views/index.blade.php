@extends('layouts.app')

@section('title')
    @guest
        Home
    @else
        Launchpad
    @endguest
@endsection

@section('hero')
    @guest  
        <x-hero bg="subtle_prism_indigo">
            <x-slot name='h1'>
                Learning is a journey that lasts a lifetime.
            </x-slot>
            We believe that education is beliefs, character, creativity, collaboration, knowledge and guidance all rolled up into one.  It is also an endeavor that never ends.
            <!-- After all, we aren't going to be with them forever. -->
        </x-hero>
    @else
        <x-hero bg="https://cdn.pixabay.com/photo/2016/03/09/09/15/rocket-1245696_1280.jpg">
            @slot('h1class', 'text-white text-center')
            <x-slot name='h1'>
                Launchpad
            </x-slot>
        </x-hero>
    @endguest
@endsection

@section('content')

<section class = "box codeflask">
    
</section>

<!-- 
    Section containing all card collections and cards
-->
<section>
    @foreach ($collections as $col)
        <div class = "box">
            <div class = "collection-header">
                <h2 class = "text-center">{{ $col->title }}</h2>
                <p class = "text-center">{{ $col->description }}</p>
            </div>
            <div class = "card-group-wrapper">
                @foreach ($col->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $card)
                <x-card
                      width="full"
                      height="h-short"
                      :card="$card" >
                </x-card>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

@endsection