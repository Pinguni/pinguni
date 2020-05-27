@extends('layouts.app')

@section('title', "$poc->title | $cou->title | Courses")

<!-- No Hero for now -->
@section('hero')
@endsection


@section('content')

<section class = "article">
    <div class = "box">
        <p><a href = "{{ App\Help::cardUrl($cou) }}">{{ $cou->title }}</a></p>
    </div>
    <div class = "box box-pocket">
        <h2>{{ $poc->title }}</h2>
        <p>{{ $poc->description }}</p>

        <!--
            Snippets
        -->
        @foreach ($poc->cards as $sni)
            <div class = "course-pages">
                <a href = '{{ url("/resources/courses/$cou->permalink/$poc->permalink/$sni->permalink") }}'>
                    <div><p>{!! App\Icon::get($sni->icon) !!} &nbsp; {{ $sni->title }}</p></div>
                </a>
            </div>
        @endforeach
    </div>
</section>

@endsection