<style>
    .guide-pages div:hover {
        cursor: pointer;
    }
</style>


<!--
    Hero
-->
<x-hero :bg="$gui->bg" class="blank">
    @slot('article', 'hero-header')
    <x-slot name='h1'>
        {{ $gui->title }}
    </x-slot>

    {{ $gui->description }}

    @guest
        <div class = "spacer"></div>
    @else
        @if ($role == 'admin')
            <div class = "spacer"></div>
            <a href = "{{ route('editCard', ['id' => $gui->id]) }}"><button>Edit</button></a>
        @endif

        @php
            $status = App\Help::userCardStatus(Auth::id(), $gui->id);
        @endphp

        @if ($status == 'inprogress')
            <button class = "inprogress">In Progress</button>
        @else
            <form method = "POST" action = "{{ route('storeCardProgress') }}">
                @csrf
                <input name = "id" id = "id" type = "hidden" value = "{{ $gui->id }}"/>
                <input name = "status" id = "status" type = "hidden" value = "inprogress"/>
                <button type = "submit">Follow this guide</button>
            </form>
        @endif
    @endguest
</x-hero>


<!--
    Card notes box
-->
<section class = "article">
    <div class = "box">
        {!! App\Help::notes($gui->notes) !!}
    </div>
</section>

<!--
    Pockets
-->
<div id = "pockets">
@foreach ($gui->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $poc)
    <section class = "article" data-id = "{{ $poc->id }}">
        <div class = "box box-pocket">
            @if ($role == 'admin') <span class = "handle"></span> @endif
            <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink") }}'>
                <h2>{{ $poc->title }}</h2>
            </a>
            <p>{{ $poc->description }}</p>

            <!--
                Pages
            -->
            <div class = "guide-pages">
                @if ($role == 'admin')
                    @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->get() as $pag)
                        <div onclick="updatePage({{ $poc->id }}, {{ $pag->id }}, '{{ $pag->title }} | {{ $poc->title }} | {{ $gui->title }} | Guides | Pinguni', '{{ App\Help::cardUrl($pag) }}')"><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                    @endforeach
                @else
                    @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag)
                        <div onclick="updatePage({{ $poc->id }}, {{ $pag->id }}, '{{ $pag->title }} | {{ $poc->title }} | {{ $gui->title }} | Guides | Pinguni', '{{ App\Help::cardUrl($pag) }}')"><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                    @endforeach
                @endif
            </div>
            @if ($role == 'admin')
                <a href = "{{ route('createCardWithParent', ['parent_id' => $poc->id]) }}"><button class = "clear">Create Page</button></a>
            @endif
        </div>
    </section>
@endforeach
</div>


<!--
    Create Pocket Button
-->
<section class = "article">
    <div class = "box">
        @if ($role == 'admin')
            <a href = "{{ route('createCardWithParent', ['parent_id' => $gui->id]) }}"><button class = "clear">Create Pocket</button></a>
        @endif
    </div>
</section>

<!--
    Resource Cards Pool
-->
<div class = "card-pool">
    <h2>Extra Resources</h2>
    <div class = "card-group-wrapper">
        @foreach ($gui->pool()->ofVisibility('public')->get() as $card)
            <x-card
                  width="full"
                  height="h-long"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</div>

<!--
    Comments
-->
