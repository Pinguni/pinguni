@extends('layouts.app')

@section('title', "Home")

@section('hero')
    @guest  
        <x-hero bg="subtle_prism_indigo">
            <x-slot name='h1'>
                Welcome to the future of learning.
            </x-slot>
            We believe that education is innovation, creativity, curiosity, character, collaboration, mentorship, and knowledge all rolled up into one.  In the era of today, it is not enough to simply know.  Students must be able to use, tweak, and invent.
        </x-hero>
    @endguest
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