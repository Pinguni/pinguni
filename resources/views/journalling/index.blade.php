@extends('layouts.app')

@section('title', 'Journalling')

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
@endsection


@section('content')
<section>
    <div class = "box">
        <div class = "collection-header">
            <h2 class = "text-center">Prompts</h2>
            <p class = "text-center"></p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($prompts as $prompt)
                <div class = "card-wrapper">
                    <div class = "card">
                        <div class = "card-img-wrapper">
                            <img src = "{{ $prompt->thumbnail }}" />
                        </div>
                        <div class = "container">
                            <div class = "content">
                                <p class = "description">{{ $prompt->prompt }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection