@extends('layouts.app')

@section('title')
    Search {{ $word ?? '' }}
@endsection

@section('head')
    <!-- Cards -->
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <!-- Infinite scroll package -->
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
@endsection

@section('mainClass', 'full')

@section('content')

<style>
    a:hover {
        cursor:pointer;
    }
</style>

<!--
    Tags sidebar
-->
<aside class = "sidebar">
    <div class = "box">
        <!-- <p class = "menu-1-header">Price</p>
        <p class = "menu-1" onclick="getCards('!freemium')">Completely Free</p>
        <p class = "menu-1" onclick="getCards('freemium')">Freemium</p>

        <br /> -->

        <p class = "menu-1-header">Resource Types</p>
        <p class = "menu-1" onclick="getCards('guides')">Guides</p>
        <p class = "menu-1" onclick="getCards('links')">Links</p>
        <p class = "menu-1" onclick="getCards('pockets')">Pockets</p>
        <p class = "menu-1" onclick="getCards('topics')">Topics</p>
        <!-- <p class = "menu-1" onclick="getCards('guides')">Guides</p> -->

        <br />

        <p class = "menu-1-header">Subjects</p>
        <p class = "menu-1" onclick="getCards('all subjects')">All Subjects</p>
        <p class = "menu-1" onclick="getCards('art')">Art</p>
        <p class = "menu-1" onclick="getCards('bible')">Bible</p>
        <p class = "menu-1" onclick="getCards('foreign language')">Foreign Language</p>
        <p class = "menu-1" onclick="getCards('language arts')">Language Arts</p>
        <p class = "menu-1" onclick="getCards('math')">Math</p>

        <br />

        <p class = "menu-1-header">Other Types</p>
        <p class = "menu-1" onclick="getCards('games')">Games</p>
        <p class = "menu-1" onclick="getCards('pdfs')">PDFs</p>
        <p class = "menu-1" onclick="getCards('textbooks')">Textbooks</p>

        <br />

        <p class = "menu-1-header">Learning Tools</p>
        <p class = "menu-1" onclick="getCards('tools')">All Tools</p>
        <p class = "menu-1" onclick="getCards('presentations')">Presentations</p>
    </div>
    
</aside>



<section class = "section container-wrap">
    
    <!-- 
        Sidebar whitespace div
    -->
    <div class = "sidebar-whitespace"></div>
    
    
    <!--
        Card Container
    -->
    <div class = "sidebar-container">
        
        <!--
            Tag crumbs
        -->
        <div id = "tagCrumbs"></div>
        
        <!--
            Cards
        -->
        <div id = "holder">
            <div id = "card-wrap" class = "card-group-wrapper">
                @foreach ($cards as $card)
                    <x-card
                          width="full"
                          height="h-long"
                          :card="$card" >
                    </x-card>
                @endforeach
            </div>
            {{ $cards->links() }}
        </div>
    </div>
</section>
@endsection


@section('scripts')

<!--
    Infinite scroll for cards
-->
<script>
    $('.pagination').hide();
    $('#card-wrap').infiniteScroll({
        // options
        path: '.pagination li.active + li a',
        append: '.card-wrapper',
        history: false,
    });
</script>

<!--
    AJAX request for cards (search by tag)
-->
<script>
    var tags = [];
    function getCards(tag) 
    {
        /**
         *  Check to see if node exists.
         *  If exists, remove.  If not, create.
         */

        // Set node tagDOM
        var tagDOM = document.getElementById(tag)

        // if node does not exist
        if (tagDOM === null)
        {
            tags.push(tag)  // Push tag to tag array

            var para = document.createElement("p")  // Create paragraph element

            para.id = tag  // Add id to paragraph element

            // Create text node
            var text = tag + ' <a onclick="getCards(' + "'" + tag + "'" + ')">&times;</a>'

            para.innerHTML = text  // Append tag text to paragraph

            tagCrumbs.appendChild(para)  // Append tag to tagCrumbs
        }
        // if node exists
        else {
            // Remove node 
            tagDOM.remove()

            // Remove tag from tags array
            var newTags = tags.filter(item => item !== tag)

            // Set tags to newTags
            tags = newTags

        }

        // destroy current infinite scroll container
        $('#card-wrap').infiniteScroll('destroy')

        /**
         *  getting the cards with AJAX
         */
        var url = '{{ url("/resources/get/cards/$word,") }}'+tags;
        
        console.log(url)
        
        $.ajax({
            url: url,
            method: "GET",
            success: function(response) {
                // put cards into #holder div
                var holder = document.getElementById("holder")
                holder.innerHTML = response
                /*console.log(response, "response")
                // set page title
                window.history.pushState( { "html": response.html }, "", url); */

                // execute infinite scroll
                $('.pagination').hide()
                $('#card-wrap').infiniteScroll({
                    // options
                    path: '.pagination li.active + li a',
                    append: '.card-wrapper',
                    history: false,
                });
            }
        }) 
    }
</script>

@endsection
