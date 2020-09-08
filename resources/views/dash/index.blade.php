@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
<link href = "/css/components/cards.css" rel = "stylesheet" />
@endsection

@section('hero')
<x-hero bg="default" class="blank">
    @slot('class', 'short')
    <x-slot name='h1'>
        Dashboard
    </x-slot>
</x-hero>
@endsection

@section('content')

<section class = "box card-group">
    <div class = "card-group-header">
        <h2>Guides Progress</h2>
    </div>
    <div class = "container-wrap">
        @foreach ($cards as $card)
            <x-card
                  width="full"
                  height="h-short"
                  hideType="hidden"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</section>

<!-- <section class = "box card-group">
    <div class = "card-group-header">
        <h2>Pockets Progress</h2>
    </div>
</section> -->

@endsection

