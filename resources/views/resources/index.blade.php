@extends('layouts.app')

@section('title', "Resources")

@section('content')

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
                      hideType="hidden"
                      :card="$card" >
                </x-card>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

@endsection