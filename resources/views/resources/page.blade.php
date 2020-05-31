@extends('layouts.app')

@section('title')
    {{ $card->title }} | Resources
@endsection


@section('hero')
    
    <x-hero :bg="$card->bg" class="blank">
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
    <a href = "#all"><button id = "allbtn">All</button></a>
    <a href = "#top"><button id = "topbtn">Top Resources</button></a>
    <a href = "#topics"><button id = "topicsbtn">Topics</button></a>
    <a href = "#courses"><button id = "coursesbtn">Courses</button></a>
    <a href = "#tracks"><button id = "tracksbtn">Tracks</button></a>
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
            <p>Related topics.</p>
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
        Courses section
    -->
    <section class = "box can-hide" id = "courses">
        <div class = "card-group-header">
            <h2>Courses</h2>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('course')->get() as $child)
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
        Course tracks section
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
            $('#topbtn').click(function() {
                $(this).addClass('inprogress');
                $('.can-hide').hide();
                $('#top').show();
            })
            $('#topicsbtn').click(function() {
                $(this).addClass('inprogress');
                $('.can-hide').hide();
                $('#topics').show();
            })
            $('#coursesbtn').click(function() {
                $(this).addClass('inprogress');
                $('.can-hide').hide();
                $('#courses').show();
            })
            $('#tracksbtn').click(function() {
                $(this).addClass('inprogress');
                $('.can-hide').hide();
                $('#tracks').show();
            })
            $('#allbtn').click(function() {
                $(this).addClass('inprogress');
                $('.can-hide').hide();
                $('#all').show();
            })
        })
    </script>
@endif


@endsection