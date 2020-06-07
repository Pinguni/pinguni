@extends('layouts.app')

@section('title', 'Dashboard')

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
                  width="horizontal"
                  height="h-short"
                  hideType="hidden"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</section>

<section class = "box card-group">
    <div class = "card-group-header">
        <h2>Pockets Progress</h2>
    </div>
</section>

@endsection

