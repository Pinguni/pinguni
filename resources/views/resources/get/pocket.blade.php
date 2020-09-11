<!--
    Breadcrumbs
-->
<div class = "box box-breadcrumbs">
    <p>>&nbsp; <a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a> ></p>
</div>

<!--
    Image
-->
<div class = "box">
    <img src = "{{ $poc->bg }}" />
</div>

<div class = "box box-pocket">
    <!--
        Edit Button
    -->
    @if ($role == 'admin')
        <a href = "{{ route('editCard', ['id' => $poc->id]) }}"><button>Edit</button></a>
    @endif
    
    <!--
        Pocket Information
    -->
    <h2>{{ $poc->title }}</h2>
    <p>{{ $poc->description }}</p>
    
    <!--
        Pages
    -->
    <div class = "guide-pages">
        @if ($role == 'admin')
            @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->get() as $pag)
                <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}' data-id = "{{ $pag->id }}">
                    <span class = "handle"></span><div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                </a>
            @endforeach
        @else
            @foreach ($poc->cards()->orderBy('cards_and_cards.sort')->ofVisibility('public')->get() as $pag)
                <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink/$pag->id/$pag->permalink") }}' data-id = "{{ $pag->id }}">
                    <div><p>{!! App\Icon::get($pag->icon) !!} &nbsp; {{ $pag->title }}</p></div>
                </a>
            @endforeach
        @endif
    </div>
    
    @if ($role == 'admin')
        <a href = "{{ route('createCardWithParent', ['parent_id' => $poc->id]) }}"><button class = "clear">Create Page</button></a>
    @endif
</div>

<!--
    Resource Cards Pool
-->
<div class = "card-pool">
    <h2>Extra Resources</h2>
    <div class = "card-group-wrapper">
        @foreach ($poc->pool()->ofVisibility('public')->get() as $card)
            <x-card
                  width="full"
                  height="h-long"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</div>