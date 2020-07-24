@extends('layouts.app')

@section('title', "$poc->title | $gui->title | Guides")


@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
@endsection


@section('content')

<section class = "article">
    
    <div class = "box">
        <p>>&nbsp; <a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a> ></p>
    </div>
    
    <!--
        Image
    -->
    <div class = "box">
        <img src = "{{ $poc->bg }}" />
    </div>
    
    <div class = "box box-pocket">
        <!--
            Edit Button
        -->
        @if ($role == 'admin')
            <a href = "{{ route('editCard', ['id' => $poc->id]) }}"><button>Edit</button></a>
        @endif
        
        <!--
            Pocket Information
        -->
        <h2>{{ $poc->title }}</h2>
        <p>{{ $poc->description }}</p>
        
        <!--
            Pages
        -->
        <div class = "guide-pages">
            @if ($role == 'admin')
                @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->get() as $pag)
                    <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}' data-id = "{{ $pag->id }}">
                        <span class = "handle"></span><div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                    </a>
                @endforeach
            @else
                @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag)
                    <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}' data-id = "{{ $pag->id }}">
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

<!--
    Resource Cards Pool
-->
<div class = "card-pool">
    <h2>Extra Resources</h2>
    <div class = "card-group-wrapper">
        @foreach ($poc->pool()->ofVisibility('public')->get() as $card)
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
        
        var target = $('.guide-pages');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray', { attribute: 'data-id'})
               updateToDatabase(sortData.join(','), "{{ $poc->id }}")
            }
        })
        
    })
</script>
@endsection