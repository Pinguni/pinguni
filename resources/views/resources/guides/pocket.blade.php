@extends('layouts.app')

@section('title', "$poc->title | $gui->title | Guides")

<!-- No Hero for now -->
@section('hero')
@endsection


@section('content')

<section class = "article">
    <div class = "box">
        <p><a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a></p>
    </div>
    <div class = "box box-pocket">
        <h2>{{ $poc->title }}</h2>
        <p>{{ $poc->description }}</p>
        @guest
        @else
            @if (Auth::user()->role == 'admin')
                <a href = "{{ route('editCard', ['id' => $poc->id]) }}" class = "float-right"><button>Edit</button></a>
            @endif

        <!--
            Snippets
        -->
        @foreach ($poc->cards as $sni)
            <div class = "guide-pages">
                <a href = '{{ url("/resources/guides/$gui->permalink/$poc->permalink/$sni->permalink") }}'>
                    <div><p>{!! App\Icon::get($sni->icon) !!} &nbsp; {{ $sni->title }}</p></div>
                </a>
            </div>
        @endforeach
    </div>
</section>

@endsection