@extends('layouts.app')

@section('title', "$poc->title | $gui->title | Guides")


@section('head')
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
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
        @endguest
        
        <!--
            Snippets
        -->
        <div class = "guide-pages">
        @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag)
            <a href = '{{ url("/resources/guides/$gui->permalink/$poc->permalink/$pag->permalink") }}' data-id = "{{ $pag->id }}">
                <div>@if ($role == 'admin') <span class = "handle"></span> @endif <p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
            </a>
        @endforeach
    </div>
</section>

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