@extends('layouts.app')

@section('title', "$cou->title | Courses")


@section('hero')
<x-hero :bg="$cou->bg" class="blank">
    @slot('article', 'article course-header')
    <x-slot name='h1'>
        {{ $cou->title }}
    </x-slot>
    
    {{ $cou->description }}
    @guest
        <div class = "mb-12"></div>
    @else
        @php
            $status = App\Help::userCardStatus(Auth::id(), $cou->id);
        @endphp
    
        @if ($status == 'inprogress')
            <button class = "inprogress">In Progress</button>
        @else
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "number" value = "{{ $cou->id }}" class = "hidden"/>
                <input name = "status" id = "status" type = "text" value = "inprogress" class = "hidden"/>
                <button type = "submit">Take this course</button>
            </form>
        @endif
    @endguest
</x-hero>
@endsection


@section('content')

<!--
    Card notes box
-->
<section class = "article">
    <div class = "box">
        {!! App\Help::notes($cou->notes) !!}
    </div>
</section>

<!--
    Pockets
-->
@foreach ($cou->cards as $poc)
    <section class = "article">
        <div class = "box box-pocket">
            <h2>{{ $poc->title }}</h2>
            <p>{{ $poc->description }}</p>
            
            <!--
                Snippets
            -->
            @foreach ($poc->cards as $pag)
                <div class = "course-pages">
                    <a href = '{{ url("/resources/courses/$cou->permalink/$poc->permalink/$pag->permalink") }}'>
                        <div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endforeach


@endsection