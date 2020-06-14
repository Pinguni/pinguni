<!-- 
    Page Hero 
-->
<section id = "hero" style = 'background-image: url("{{ $bg }}")' class = "{{ $class ?? '' }}">
    <div>
        @if (isset($h1) && isset($slot))
            <div class = "{{ $article ?? '' }} hero-header">
                <h1 class = "{{ $h1class ?? '' }}">{{ $h1 ?? '' }}</h1>
                <p>{{ $slot ?? '' }}</p>
            </div>
        @endif
        <!-- Whitespace Div 
        <div class = "w-full md:w-1/3"></div> -->
    </div>
</section>