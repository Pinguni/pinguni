@extends('layouts.app')

@section('title', "Home")

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/once/landing.css" rel = "stylesheet" />
    <!-- Parallax -->
    <script src = "/js/parallax/parallax.min.js"></script>
@endsection

@section('hero')
    <div id = "landing" 
         class = "parallax-window" 
         data-parallax = "scroll" 
         data-image-src = "https://i.ibb.co/mRQTSk0/stonepath.jpg"
    >
        <div class = "hero">
            <!-- <img src = "/img/flippedbook.svg" /> -->
            <h1>Chart Your Own Learning Journey</h1>
            <div class = "content">
                <p>Whether you're in high school, college, gap year, or beyond, we have something for you.</p>
                <a href = "https://forms.gle/ronezGsAT4JmCKERA"><button>Apply</button></a>
            </div>
        </div>
        <!-- SVG Waves from https://www.shapedivider.app/ -->
        <div class="custom-shape-divider-bottom-1591391235">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
@endsection


@section('content')

<!--
    Charting Your Own Course
-->
<section>
    <div class = "box box-pull">
        <div class = "pull-left">
            <div class = "collection-header">
                <h2>Do What Works For You</h2>
                <p>Traditional schooling is expensive, restraining, and takes a long time.</p>
                <p><strong>Wouldn't it be better to have the freedom to create your own personal growth route?</strong>  All that's required is determination, hard work, and an open mind.</p>
            </div>
        </div>
        <div class = "pull-right">
            <div class = "img-wrapper">
                <img src = "https://i.ibb.co/8DCBQDW/armsup.jpg" />
            </div>
        </div>
    </div>
</section>

<!--
    Exploring Different Topics
-->
<section>
    <div class = "box box-pull">
        <div class = "pull-left">
            <div class = "img-wrapper">
                <img src = "https://i.ibb.co/sQ7P4Bt/learning.jpg" />
            </div>
        </div>
        <div class = "pull-right">
            <div class = "collection-header">
                <h2>Explore a Variety of Topics</h2>
                <p>Universities and colleges may offer a wide selection of courses, but they're not always what you want.  Besides, each takes up a semester's worth of time.</p>
                <p>Instead of suffering through sixteen weeks of a topic you don't enjoy, have the chance to <strong>learn whatever you want, whenever you want</strong>.</p>
            </div>
        </div>
    </div>
</section>

<!--
    Be Challenged
-->
<section>
    <div class = "box box-pull">
        <div class = "pull-left">
            <div class = "collection-header">
                <h2>Be Challenged</h2>
                <p>Let's face it.  Sometimes professors take too long to speak, and sometimes they teach too fast.  <strong>The sweet spot</strong>, however, is something only <em>you</em> can find - and we challenge, we <em>dare</em> you - to find that spot.</p>
            </div>
        </div>
        <div class = "pull-right">
            <div class = "img-wrapper">
                <img src = "https://i.ibb.co/wgjxmFc/persononcliff.jpg" />
            </div>
        </div>
    </div>
</section>

<!-- 
    Something for Everyone

<section>
    <div class = "box">
        <div class = "collection-header">
            <h2>Something for Everyone</h2>
            <p>Tagline</p>
        </div>
        <div class = "row-three">
            
        </div>
    </div>
</section>-->

<!-- 
    The Pinguni Suite
-->
<section class = "suite">
    <div class = "box box-suite">
        <!-- <div class = "collection-header">
            <h2>The Pinguni Suite</h2>
            <p>Explore all the tools Pinguni has to offer.</p>
        </div> -->
        <div class = "card-group-wrapper">
            <x-card
                  width="full"
                  height="h-short"
                  hideType="hidden"
                  :card="$mypCard" >
            </x-card>
            <x-card
                  width="full"
                  height="h-short"
                  hideType="hidden"
                  :card="$resCard" >
            </x-card>
            <x-card
                  width="full"
                  height="h-short"
                  hideType="hidden"
                  :card="$jouCard" >
            </x-card>
        </div>
    </div>
</section>

@endsection