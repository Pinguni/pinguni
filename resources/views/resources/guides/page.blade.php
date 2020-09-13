@extends('layouts.app')

@section('title')
@if(isset($pag->title))
{{ $pag->title }} | {{ $poc->title }} | {{ $gui->title }}
@else
{{ $gui->title }}
@endif
@endsection

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <link href = "/css/components/links.css" rel = "stylesheet" />
    <link href = "/css/components/comments.css" rel = "stylesheet" />

    <!-- Parallax -->
    <script src = "/js/parallax/parallax.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
@endsection


@section('mainClass', 'full')


@section('content')

<style>
    a:hover {
        cursor: pointer;
    }
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

<!--
    Sidebar
-->
<aside class = "sidebar">
    <div class = "box">
        <p class = "menu-1-header title"><a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a></p>
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
<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/224691c555.js" crossorigin="anonymous"></script>

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
@elseif (isset($poc->id))
    <script>
        $(window).ready(function() {
            var url = '{{ url("/resources/get/pocket/$gui->id") }}'+"/"+{{ $poc->id }};

            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // put content into #holder div
                    var holder = document.getElementById("holder")
                    holder.innerHTML = response
                    // set draggable
                    setTarget(".guide-pages", {{ $poc->id }})
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
                    // set draggable
                    setTarget("#pockets", {{ $gui->id }})
                }
            })
        });
    </script>
@endif


<script>
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
    function setTarget(target, id) {
        var target = $(target);
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui) {
                var sortData = target.sortable('toArray', { attribute: 'data-id'})
                updateToDatabase(sortData.join(','), id)
            }
        })
    }
</script>


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

<script>
    let count2 = 0;
    function addComment() {
        const user_id = $("#user_id").val()
        const card_id = $("#card_id").val()
        const comment = $("#comment").val()
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ url("/resources/comments/store") }}',
            method: "POST",
            data: { 
                user_id: user_id, 
                card_id: card_id, 
                comment: comment 
            },
            success: function (response) {                
                let div = document.createElement("div")         // create div
                div.id = ++count2 + '-com';
                div.classList.add("comment")

                let divInner = document.createElement("div")    // create inner div
                divInner.id = count2 + '-inner';
                let pU = document.createElement("p")            // create p.user
                pU.classList.add("user")
                //pU.innerHTML = " Auth::user()->username "
                let pT = document.createElement("p")            // create p.time
                pT.classList.add("time")
                pT.innerHTML = "{{ date('M j') }}"
                let p = document.createElement("p")             // create p.comment
                p.classList.add("comment")
                p.innerHTML = comment

                var comments = document.getElementById("comments")      // get #comments div
                comments.prepend(div);                                  // prepend div to #comments

                document.getElementById(count2 + '-com').appendChild(divInner)    // append divInner to div
                document.getElementById(count2 + '-com').appendChild(p)           // append p to div

                document.getElementById(count2 + '-inner').appendChild(pU)        // append pU to divInner
                document.getElementById(count2 + '-inner').appendChild(pT)        // append pT to divInner

                $("#comment").val('')                                   // clear #comment value
            }
        })
    }
    function destroyComment(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ url("/resources/comments/destroy") }}' + '/' + id,
            type: "DELETE",
            success: function (response) {                
                var comment = document.getElementById("comment-" + id)      // remove deleted comment
                comment.remove()
            }
        })
    }
</script>

@endsection