@extends('layouts.app')

@section('title')
    {{ $card->title }} | Resources
@endsection


@section('hero')
    
    <x-hero :bg="$card->bg" class="blank">
        @slot('article', 'article hero-header')
        <x-slot name="h1">
            {{ $card->title }}
        </x-slot>
        <!-- Include parent topics somewhere -->
        <p>{{ $card->description }}</p>
    </x-hero>

@endsection


@section('content')

<!--
    Menu for page boxes
-->
<section class = "box box-button">
    <button id = "allbtn">All</button>
    <button id = "topbtn">Top Resources</button>
    <button id = "topicsbtn">Topics</button>
    <button id = "guidesbtn">Guides</button>
    <button id = "tracksbtn">Tracks</button>
</section>

<!--
    Card notes box
-->
<section class = "box">
    {!! App\Help::notes($card->notes) !!}
</section>


@if ($card->title == 'Resources')

    <!--
        Special section for Resources page
    -->
    <section class = "box" id = "resources">
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('resource')->get() as $child)
                {!! App\Help::card($child) !!}
            @endforeach
        </div>
    </section>

@else
    
    <!--
        Top Resources section
    -->
    <section class = "box can-hide" id = "top">
        <div class = "card-group-header">
            <h2>Top Resources</h2>
            <p>Our top picks for this topic.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->notOfType('resource')->notOfType('topic')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Topic cards section
    -->
    <section class = "box can-hide" id = "topics">
        <div class = "card-group-header">
            <h2>Topics</h2>
            <p>Sub-topics and other topics related to {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('topic')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Guides section
    -->
    <section class = "box can-hide" id = "guides">
        <div class = "card-group-header">
            <h2>Guides</h2>
            <p>Guides for {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('guide')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Guide tracks section
    -->
    <section class = "box can-hide" id = "tracks">
        <div class = "card-group-header">
            <h2>Tracks</h2>
            <p>Customized learning pathways.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('track')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        All resources
    -->
    <section class = "box can-hide" id = "all">
        <div class = "card-group-header">
            <h2>All Resources</h2>
            <p>All materials associated with {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <script>
        $(window).ready(function() {
            $('.can-hide').hide();
            
            // Show All Resources when page opens
            $('#all').show();
            $('#all').addClass('selected');
            
            $('#allbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#all').show();
            })
            $('#topbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#top').show();
            })
            $('#topicsbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#topics').show();
            })
            $('#guidesbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#guides').show();
            })
            $('#tracksbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#tracks').show();
            })
        })
    </script>
@endif


@endsection