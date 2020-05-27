@extends('layouts.app')

@section('title', 'About')

@section('hero')
<x-hero bg="https://cdn.pixabay.com/photo/2015/12/15/06/42/kids-1093758_1280.jpg" class="blank">
    @slot('article', 'article')
    @slot('class', 'short')
    <x-slot name='h1'>
        About
    </x-slot>
</x-hero>
@endsection

@section('content')

<section class = "article">
    
    <div class = "box">
        <p>Welcome to <a href = "{{ url('/') }}">Masa HaChaim</a>!  We're excited to have you join us on this wonderful journey of lifelong learning.</p>
    </div>
    
    <div class = "box">
        <h2>What do we do?</h2>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2014/01/30/01/55/wheel-rim-254714_1280.jpg" />
            <div>
                <h3>We're not trying to reinvent the wheel.</h3>
                <p>Instead, we strive to pick and choose the best parts and put them together for you.</p>
            </div>
        </div>
    </div>
    
    <div class = "box">
        <h2>What do we believe?</h2>
        <div class = "box box-explain">
            <img src = "http" />
            <div>
                <h3>The world needs kids who are prepared to change the future.</h3>
                <p>This is the most fundamental </p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2017/02/13/08/54/brain-2062057_1280.jpg" />
            <div>
                <h3>Educating both sides of the brain.</h3>
                <p>In the Digital Age, when computers can do better than humans at certain routine jobs, being able to exercise the fundamental essence of what makes us human is more important than ever.  We can "think outside the box", be creative, and show empathy.  Robots can't.  (See <em>A Whole New Mind</em> by Daniel H. Pink and <em>Unselfie</em> by Michele Borba.)</p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2016/08/20/09/46/magnifying-glass-1607160_1280.jpg" />
            <div>
                <h3>Innovative education.</h3>
                <p>Learning isn't just about memorizing facts.  Students should also be able to use, analyze, and think critically about knowledge.  ___innovate  (See <em>Most Likely to Succeed</em>, <em>Creating Inovators</em>, <em>A Whole New Mind</em>.)</p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2016/08/11/23/55/redwood-national-park-1587301_1280.jpg" />
            <div>
                <h3>Students ought to have a choice.</h3>
                <p>Students should play a large part in what they choose to learn and when to learn it - within appropriate boundaries, of course.  (See <em>A School of Our Own</em> by Samuel Levin and <em>Drive</em> by Daniel H. Pink.)</p>
            </div>
        </div>
        <!-- <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2017/07/25/01/22/cat-2536662_1280.jpg" />
            <div>
                <h3>Creativity builds on top of the resources one already has.</h3>
                <p>The more students know, the more knowledge they will have to work with to come up with new ideas and create unique things.  (See <em>Curious</em> by Ian Leslie.)</p>
            </div>
        </div> -->
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2018/03/16/04/40/grid-3230205_1280.jpg" />
            <div>
                <h3>Learning cannot be linear.</h3>
                <p>Knowledge isn't always linear.  So why should learning be?</p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "http" />
            <div>
                <h3>Learning is not a solitary endeavor.</h3>
                <p>paragraph</p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2016/04/05/03/18/prayer-1308663_1280.jpg" />
            <div>
                <h3>Education incorporates a set of values, whether or not we like it.</h3>
                <p>We may think education and beliefs (or religion, if you want to take it that far) can be separated.  In reality, this is impossible.  Every piece of work used for learning - whether textbooks, novels, or videos - presents the worldview and values of its writer.  (See.)</p>
            </div>
        </div>
        <div class = "box box-explain">
            <img src = "https://cdn.pixabay.com/photo/2017/12/27/12/41/picture-frame-3042585_1280.jpg" />
            <div>
                <h3>There is such a thing as a visual language.</h3>
                <p>Words are important, but they are no longer enough.  (See <em>The Doodle Revolution</em> by Sunni Brown.)</p>
            </div>
        </div>
        <ul class = "list-disc ml-6">
            <li>Reflections on learning and daily journalling are important parts of the learning experience.</li>
            <li>Content should be arranged by skill level (and wide age groups) rather than grade.  Every student is different, and what is good for one is not necessarily appropriate for the other.</li>
        </ul>
        <!-- <div class = "box box-explain">
            <img src = "http" />
            <div>
                <h3>title</h3>
                <p>paragraph</p>
            </div>
        </div> -->
    </div>
    
</section>

@endsection