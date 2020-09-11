<!-- 
    Parallax 
-->
<script src = "/js/parallax/parallax.min.js"></script>
<!-- 
    Page Hero 
-->
<section id = "hero" 
         class = "{{ $class ?? '' }} parallax-window"
         data-parallax = "scroll" 
         data-image-src = "{{ $bg }}"
>
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