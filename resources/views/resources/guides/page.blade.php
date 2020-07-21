@extends('layouts.app')

@section('title', "$pag->title | $poc->title | $gui->title | Guides")

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
@endsection

@section('content')
<section class = "article">
    
    <!--
        Breadcrumbs
    -->
    <div class = "box">
        <p>>&nbsp; <a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a> > <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink") }}'>{{ $poc->title }}</a></p>
    </div>
    
    <!--
        Image
    -->
    <div class = "box">
        <img src = "{{ $pag->bg }}" />
    </div>
    
    <!-- 
        Page Info
    -->
    <div class = "box">
        <h2>{{ $pag->title }}</h2>
        <p class = "page-description"><a href = "{{ App\Help::getPageContributionUrl($pag->id) }}" target = "_blank">#{{ $pag->id }}</a> | {{ $pag->description }}</p>
    </div>
    
    <!--
        Page Content
    -->
    <div class = "box" id = "content"></div>
    
    <!--
        Completion
    -->
    <div class = "box">
        @php
            $status = App\Help::userCardStatus(Auth::id(), $pag->id);
        @endphp
    
        @if ($status == 'complete')
            <!--
                Already Finished button
            -->
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "hidden" value = "{{ $pag->id }}"/>
                <input name = "status" id = "status" type = "hidden" value = "inprogress"/>
                <button type = "submit" class = "complete">Finished</button>
            </form>
        @elseif (isset($role))
            <!-- 
                Completion Button
            -->
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "hidden" value = "{{ $pag->id }}"/>
                <input name = "status" id = "status" type = "hidden" value = "complete"/>
                <button type = "submit">Complete</button>
            </form>
        @endif
        @if ($role == 'admin')
            <a href = "{{ route('editCard', ['id' => $pag->id]) }}"><button class = "edit">Edit</button></a>
        @endif
    </div>
    
</section>

<!--
    Resource Cards Pool
-->
<div class = "card-pool">
    <h2>Extra Resources</h2>
    <div class = "card-group-wrapper">
        @foreach ($gui->pool()->ofVisibility('public')->get() as $card)
            <x-card
                  width="full"
                  height="h-long"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</div>

<script src="https://utteranc.es/client.js"
        repo="Pinguni/comments"
        issue-term="url"
        theme="github-light"
        crossorigin="anonymous"
        async>
</script>
@endsection


@section('scripts')
<script>
    $(window).ready(function() {
        $.ajax({
            url: "{{ App\Help::getPageContent($pag->id) }}",
            method: "GET",
            success: function(response) {
                // put content into #content div
                var content = document.getElementById("content")
                content.innerHTML = response
            }
        })
    });
</script>
@endsection