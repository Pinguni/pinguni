<!--
    Breadcrumbs
-->
<div class = "box box-breadcrumbs">
    <p>>&nbsp; <a href = "{{ App\Help::cardUrl($gui) }}">{{ $gui->title }}</a> > <a href = '{{ url("/resources/guides/$gui->permalink/$poc->id/$poc->permalink") }}'>{{ $poc->title }}</a> ></p>
</div>

<!--
    Image
-->
<div class = "box">
    <img src = "{{ $pag->bg }}" />
</div>

<!-- 
    Page Info
-->
<div class = "box box-page-title">
    <h2>{{ $pag->title }}</h2>
    <p class = "page-description">{{ $pag->description }}</p>
</div>

<!--
    Page Content
-->
<div class = "box box-content">{!! $pag->notes !!}</div>

<!--
    Links
-->
<div class = "box" id = "links">
    <h2>Links</h2>
    @if ($role == 'admin')
        <input 
            id = "link" 
            type = "text" 
            name = "link"
            placeholder = "add link..." 
            onkeypress="runScript(event, {{ $pag->id }})"
        />
    @endif
    @foreach ($pag->links()->get() as $link)
        <a class = "link" href = "{{ $link->url }}" target="_blank">
            <div>
                <div class = "content">
                    <p class = "title">@if ($role == 'admin'){{ $link->id }} |@endif {{ $link->title }}</p>
                    <p class = "description">{{ $link->description }}</p>
                </div>
                <div class = "image-wrapper">
                    <img src = "{{ $link->image }}" />
                </div>
            </div>
        </a>
    @endforeach
</div>

<!--
    Completion
-->
<div class = "box">
    @php
        $status = App\Help::userCardStatus(Auth::id(), $pag->id);
    @endphp

    @if ($status == 'complete')
        <!--
            Already Finished button
        -->
        <form method = "POST" action = "{{ route('storeCardProgress') }}">
            @csrf
            <input name = "id" id = "id" type = "hidden" value = "{{ $pag->id }}"/>
            <input name = "status" id = "status" type = "hidden" value = "inprogress"/>
            <button type = "submit" class = "complete">Finished</button>
        </form>
    @elseif (isset($role))
        <!-- 
            Completion Button
        -->
        <form method = "POST" action = "{{ route('storeCardProgress') }}">
            @csrf
            <input name = "id" id = "id" type = "hidden" value = "{{ $pag->id }}"/>
            <input name = "status" id = "status" type = "hidden" value = "complete"/>
            <button type = "submit">Complete</button>
        </form>
    @endif
    @if ($role == 'admin')
        <a href = "{{ route('editCard', ['id' => $pag->id]) }}"><button class = "edit">Edit</button></a>
    @endif
</div>

<!--
    Resource Cards Pool
-->
<div class = "card-pool">
    <h2>Extra Resources</h2>
    <div class = "card-group-wrapper">
        @foreach ($pag->pool()->ofVisibility('public')->get() as $card)
            <x-card
                  width="full"
                  height="h-long"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
</div>



