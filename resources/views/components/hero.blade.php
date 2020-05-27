<!-- 
    Page Hero 
-->
<section id = "hero" style = 'background-image: url("{{ $bg }}")' class = "{{ $class ?? '' }}">
    <div>
        <div class = "{{ $article ?? '' }}">
            <h1 class = "{{ $h1class ?? '' }}">{{ $h1 }}</h1>
            <p>{{ $slot }}</p>
        </div>
        <!-- Whitespace Div -->
        <div class = "w-full md:w-1/3"></div>
    </div>
</section>