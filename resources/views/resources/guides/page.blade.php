@extends('layouts.app')

@section('title', "$pag->title | $poc->title | $gui->title | Guides")

@section('content')
<section class = "article">
    
    <!--
        Breadcrumbs
    -->
    <div class = "box">
        <p><a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a> > <a href = '{{ url("/resources/guides/$gui->permalink/$poc->permalink") }}'>{{ $poc->title }}</a></p>
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
        <p class = "page-description">{{ $pag->description }}</p>
    </div>
    
    <!--
        Page Content
    -->
    <div class = "box">
        {!! App\Help::notes($pag->notes) !!}
        
    </div>
    
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
@endsection