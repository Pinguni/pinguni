@extends('layouts.app')

@section('title', "$gui->title | Guides")

@section('head')
    <link href = "/css/components/buttons.css" rel = "stylesheet" />
    <link href = "/css/components/cards.css" rel = "stylesheet" />

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
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
<div id = "pockets">
@foreach ($gui->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $poc)
    <section class = "article" data-id = "{{ $poc->id }}">
        <div class = "box box-pocket">
            @if ($role == 'admin') <span class = "handle"></span> @endif
            <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink") }}'>
                <h2>{{ $poc->title }}</h2>
            </a>
            <p>{{ $poc->description }}</p>
            
            <!--
                Pages
            -->
            <div class = "guide-pages">
                @if ($role == 'admin')
                    @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->get() as $pag)
                        <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}'>
                            <div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                        </a>
                    @endforeach
                @else
                    @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag)
                        <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}'>
                            <div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                        </a>
                    @endforeach
                @endif
            </div>
            @if ($role == 'admin')
                <a href = "{{ route('createCardWithParent', ['parent_id' => $poc->id]) }}"><button class = "clear">Create Page</button></a>
            @endif
        </div>
    </section>
@endforeach
</div>


<!--
    Create Pocket Button
-->
<section class = "article">
    <div class = "box">
        @if ($role == 'admin')
            <a href = "{{ route('createCardWithParent', ['parent_id' => $gui->id]) }}"><button class = "clear">Create Pocket</button></a>
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

<!--
    Utteranc.es Comments
-->
<script src="https://utteranc.es/client.js"
        repo="Pinguni/comments"
        issue-term="url"
        theme="github-light"
        crossorigin="anonymous"
        async>
</script>

@endsection


@section('scripts')
<style>
    .highlight {
        background: #f7e7d3;
        min-height: 30px;
        list-style-type: none;
    }

    .handle {
        min-width: 18px;
        background: #607D8B;
        height: 15px;
        display: inline-block;
        cursor: move;
        margin-right: 10px;
    }
</style>
<script>
    $(document).ready(function(){

    	function updateToDatabase(idString, parentId) {
    	   $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
    		
    	   $.ajax({
              url: '{{ route("reorderCards") }}',
              method: 'POST',
              data: { child_ids: idString, parent_id: parentId },
              success: function() {
                 alert('Successfully updated')
               	 //do whatever after success
              }
           })
    	}
        
        var target = $('#pockets');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray', { attribute: 'data-id'})
               updateToDatabase(sortData.join(','), "{{ $gui->id }}")
            }
        })
        
    })
</script>
@endsection