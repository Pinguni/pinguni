@extends('layouts.app')

@section('title', "$gui->title | Guides")

@section('head')
    <link href = "/css/components/buttons.css" rel = "stylesheet" />
@endsection

@section('hero')
<x-hero :bg="$gui->bg" class="blank">
    @slot('article', 'hero-header')
    <x-slot name='h1'>
        {{ $gui->title }}
    </x-slot>
    
    {{ $gui->description }}
    
    @guest
        <div class = "mb-12"></div>
    @else
        @if ($role == 'admin')
            <a href = "{{ route('editCard', ['id' => $gui->id]) }}"><button>Edit</button></a>
        @endif
    
        @php
            $status = App\Help::userCardStatus(Auth::id(), $gui->id);
        @endphp
    
        @if ($status == 'inprogress')
            <button class = "inprogress">In Progress</button>
        @else
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "hidden" value = "{{ $gui->id }}"/>
                <input name = "status" id = "status" type = "hidden" value = "inprogress"/>
                <button type = "submit float-right">Follow this guide</button>
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
        {!! App\Help::notes($gui->notes) !!}
    </div>
</section>

<!--
    Pockets
-->
<section class = "article">
    <div class = "box">
        @if ($role == 'admin')
            <a href = "{{ route('createCardWithParent', ['parent_id' => $gui->id]) }}"><button class = "clear">Create Pocket</button></a>
        @endif
    </div>
</section>

@foreach ($gui->cards as $poc)
    <section class = "article">
        <div class = "box box-pocket">
            <h2>{{ $poc->title }}</h2>
            <p>{{ $poc->description }}</p>
            
            <!--
                Pages
            -->
            @foreach ($poc->cards as $pag)
                <div class = "guide-pages">
                    <a href = '{{ url("/resources/guides/$gui->permalink/$poc->permalink/$pag->permalink") }}'>
                        <div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                    </a>
                </div>
            @endforeach
            @if ($role == 'admin')
                <a href = "{{ route('createCardWithParent', ['parent_id' => $poc->id]) }}"><button class = "clear">Create Page</button></a>
            @endif
        </div>
    </section>
@endforeach


@endsection