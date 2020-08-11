@extends('layouts.app')

@section('title')
@if(isset($pag->title))
{{ $pag->title }} | {{ $poc->title }} | {{ $gui->title }} | Guides
@else
{{ $gui->title }} | Guides
@endif
@endsection

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <link href = "/css/components/links.css" rel = "stylesheet" />
@endsection


@section('mainClass', 'full')


@section('content')

<style>
    a:hover {
        cursor: pointer;
    }
</style>

<!--
    Sidebar
-->
<aside class = "sidebar">
    <div class = "box">
        @foreach ($gui->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $poc2)
            <p class = "menu-1-header">{{ $poc2->title }} 
                @if($role == 'admin')
                    <a href = "{{ route('createCardWithParent', ['parent_id' => $poc2->id]) }}">
                        <img class = "emoji" src="https://img.icons8.com/pastel-glyph/64/000000/plus.png"/>
                    </a>
                @endif
            </p>    
                @foreach ($poc2->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag2)
                    <p class = "menu-1" onclick="updatePage({{ $poc2->id }}, {{ $pag2->id }}, '{{ $pag2->title }} | {{ $poc2->title }} | {{ $gui->title }} | Guides | Pinguni', '{{ App\Help::cardUrl($pag2) }}')">{{ $pag2->title }}</p>
                @endforeach
            <br />
        @endforeach
        @if ($role == 'admin')
            <p class = "menu-1-header">
                <a href = "{{ route('createCardWithParent', ['parent_id' => $gui->id]) }}">
                    Create Pocket
                </a>
            </p>
        @endif
        <br />
    </div>
</aside>


<!-- 
    Main section
-->
<section class = "section container-wrap">
    
    <!-- 
        Sidebar whitespace div
    -->
    <div class = "sidebar-whitespace"></div>
    
    
    <!-- 
        Page
    -->
    <div class = "sidebar-container" id = "holder"></div>
    
</section>


@endsection


@section('scripts')

@if (isset($pag->id))
    <script>
        $(window).ready(function() {
            var url = '{{ url("/resources/get/page/$gui->id") }}'+"/"+{{ $poc->id }}+"/"+{{ $pag->id }};

            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // put content into #holder div
                    var holder = document.getElementById("holder")
                    holder.innerHTML = response
                }
            })
        });
    </script>
@else
    <script>
        $(window).ready(function() {
            var url = '{{ url("/resources/get/guide/$gui->id") }}';

            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // put content into #holder div
                    var holder = document.getElementById("holder")
                    holder.innerHTML = response
                }
            })
        });
    </script>
@endif


<script>
    function updatePage(pocId, pagId, pagTitle, pagUrl) 
    {
        /**
         *  get the page with AJAX
         */
        var url = '{{ url("/resources/get/page/$gui->id") }}'+"/"+pocId+"/"+pagId;
        
        console.log(url)
        
        $.ajax({
            url: url,
            method: "GET",
            success: function(response) {
                // put page into #holder div
                var holder = document.getElementById("holder")
                holder.innerHTML = response
                // set page title
                document.title = pagTitle;
                window.history.pushState( { "html": response.html, "pageTitle": pagTitle }, "", pagUrl);
            }
        }) 
    }
</script>


<script>
    let count = 0;
    function runScript(e, id) {
        if (e.key === "Enter") {
            var link = $("#link").val()
            var obj = { url: link }
            console.log(obj)
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url("/link/store/") }}'+"/"+id,
                method: "POST",
                data: { url: link },
                success: function (response) {
                    console.log("It worked!")
                    
                    let a = document.createElement("a")              // create a
                    a.classList.add("link")                          // add link class
                    a.href = link                                    // set href url
                    
                    document.getElementById("links").appendChild(a)  // append a to #links
                    
                    /*let div = document.createElement("div")         // create div
                    div.id = ++count;                               // assign ID to div
                    let p = document.createElement("p")             // create p
                    p.innerHTML = note;                             // put note in p
                    
                    var notes = document.getElementById("notes")    // get #notes div
                    notes.prepend(div);                             // prepend div to #notes
                    document.getElementById(count).appendChild(p)   // append p to div
                    
                    note.value = null;                              // clear note value */
                }
            })
        }
    }
</script>

@endsection