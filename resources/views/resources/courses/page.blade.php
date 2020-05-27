@extends('layouts.app')

@section('title', "$pag->title | $poc->title | $cou->title | Courses")

@section('content')
<section class = "article">
    
    <!--
        Breadcrumbs
    -->
    <div class = "box">
        <p><a href = "{{ App\Help::cardUrl($cou) }}">{{ $cou->title }}</a> > <a href = '{{ url("/resources/courses/$cou->permalink/$poc->permalink") }}'>{{ $poc->title }}</a></p>
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
        
        @php
            $status = App\Help::userCardStatus(Auth::id(), $pag->id);
        @endphp
    
        @if ($status == 'complete')
            <!--
                Already Finished button
            -->
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "number" value = "{{ $pag->id }}" class = "hidden"/>
                <input name = "status" id = "status" type = "text" value = "inprogress" class = "hidden"/>
                <button type = "submit" class = "complete">Finished</button>
            </form>
        @else
            <!-- 
                Completion Button
            -->
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "number" value = "{{ $pag->id }}" class = "hidden"/>
                <input name = "status" id = "status" type = "text" value = "complete" class = "hidden"/>
                <button type = "submit">Complete</button>
            </form>
        @endif
    </div>
    
</section>
@endsection