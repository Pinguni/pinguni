@extends('layouts.app')

@section('title')
    {{ $card->title }} | Resources
@endsection

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/components/forms.css" rel = "stylesheet" />

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
@endsection

@section('hero')
    
    <x-hero :bg="$card->bg" class="blank">
        @slot('article', 'article hero-header')
        <x-slot name="h1">
            {{ $card->title }}
        </x-slot>
        <!-- Include parent topics somewhere -->
        <p>{{ $card->description }}</p>
        @guest
        @else
            @if (Auth::user()->role == 'admin')
                <a href = "{{ route('editCard', ['id' => $card->id]) }}"><button>Edit</button></a>
            @endif
        @endguest
    </x-hero>

@endsection


@section('content')

<!--
    Menu for page boxes
-->
<section class = "box box-button">
    <button id = "allbtn">All</button>
    <button id = "topbtn">Top Resources</button>
    <button id = "topicsbtn">Topics</button>
    <button id = "guidesbtn">Guides</button>
    <button id = "tracksbtn">Tracks</button>
</section>

<!--
    Card notes box
-->
<section class = "box">
    {!! App\Help::notes($card->notes) !!}
</section>


<!-- 
    Add child resources
-->
<section class = "box">
    <form method="POST" action="{{ route('storeCardRelation', ['parent' => $card->id]) }}">
        @csrf
        <input type = "text" name = "child_id" placeholder = "child resource id" />
        <button type = "submit">Add</button>
    </form>
</section>


@if ($card->title == 'Resources')

    <!--
        Special section for Resources page
    -->
    <section class = "box" id = "resources">
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('resource')->get() as $child)
                {!! App\Help::card($child) !!}
            @endforeach
        </div>
    </section>

@else
    
    <!--
        Top Resources section
    -->
    <section class = "box can-hide" id = "top">
        <div class = "card-group-header">
            <h2>Top Resources</h2>
            <p>Our top picks for this topic.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->notOfType('resource')->notOfType('topic')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Topic cards section
    -->
    <section class = "box can-hide" id = "topics">
        <div class = "card-group-header">
            <h2>Topics</h2>
            <p>Sub-topics and other topics related to {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('topic')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Guides section
    -->
    <section class = "box can-hide" id = "guides">
        <div class = "card-group-header">
            <h2>Guides</h2>
            <p>Guides for {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('guide')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        Guide tracks section
    -->
    <section class = "box can-hide" id = "tracks">
        <div class = "card-group-header">
            <h2>Tracks</h2>
            <p>Customized learning pathways.</p>
        </div>
        <div class = "card-group-wrapper">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->ofType('track')->get() as $child)
                <x-card
                      width="full"
                      height="h-long"
                      hideDescription="hidden"
                      :card="$child" >
                </x-card>
            @endforeach
        </div>
    </section>

    <!--
        All resources
    -->
    <section class = "box can-hide" id = "all">
        <div class = "card-group-header">
            <h2>All Resources</h2>
            <p>All materials associated with {{ $card->title }}.</p>
        </div>
        <div class = "card-group-wrapper" id = "resources">
            @foreach ($card->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $child)
                @if (!Auth::guest()) @if (Auth::user()->role == 'admin')
                    <div data-id = "{{ $child->id }}"> <span class = "handle"></span> 
                @endif @endif
                        <x-card
                              width="full"
                              height="h-long"
                              :card="$child" >
                        </x-card>
                @if (!Auth::guest()) @if (Auth::user()->role == 'admin')
                    </div>
                @endif @endif
            @endforeach
        </div>
    </section>

    <script>
        $(window).ready(function() {
            $('.can-hide').hide();
            
            // Show All Resources when page opens
            $('#all').show();
            $('#allbtn').addClass('selected');
            
            $('#allbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#all').show();
            })
            $('#topbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#top').show();
            })
            $('#topicsbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#topics').show();
            })
            $('#guidesbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#guides').show();
            })
            $('#tracksbtn').click(function() {
                $('button').removeClass('selected');
                $(this).addClass('selected');
                $('.can-hide').hide();
                $('#tracks').show();
            })
        })
    </script>
@endif

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
        
        var target = $('#resources');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray', { attribute: 'data-id'})
               updateToDatabase(sortData.join(','), "{{ $card->id }}")
            }
        })
        
    })
</script>
@endsection