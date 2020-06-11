@extends('layouts.app')

@section('title', "Home")

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/once/landing.css" rel = "stylesheet" />
@endsection

@section('hero')
    <div id = "landing">
        <div class = "hero">
            <img src = "/img/flippedbook.svg" />
            <h1>The Future of Learning</h1>
            <div class = "content">
                <p>Bringing together the best of the best in education.</p>
            </div>
        </div>
        <!-- SVG Waves from https://www.shapedivider.app/ -->
        <div class="custom-shape-divider-bottom-1591391235">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
@endsection


@section('content')
<!-- 
    Section containing different modules
-->
<section>
    <div class = "box">
        <div class = "collection-header">
            <h2 class = "text-center">Modules</h2>
            <p class = "text-center">Explore all the tools Pinguni has to offer.</p>
        </div>
        <div class = "card-group-wrapper">
            <x-card
                  width="full"
                  height="h-short"
                  hideType="hidden"
                  :card="$resCard" >
            </x-card>
        </div>
    </div>
</section>

@endsection