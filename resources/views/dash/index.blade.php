@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
    <link href = "/css/components/cards.css" rel = "stylesheet" />
    <link href = "/css/components/forms.css" rel = "stylesheet" />
    <link href = "/css/components/notes.css" rel = "stylesheet" />
@endsection

@section('hero')
<x-hero bg="default" class="blank">
    @slot('class', 'short')
    <x-slot name='h1'>
        Dashboard
    </x-slot>
</x-hero>
@endsection

@section('content')

<section class = "box box-notes">
    <div class = "box-notes-notes">
        <div class = "collection-header notes-header">
            <h2>Notes</h2>
        </div>
        <input 
            id = "note" 
            type = "text" 
            name = "note"
            placeholder = "enter a note here..." 
            onkeypress="runScript(event)"
        />
        <div class = "notes" id = "notes">
            @foreach ($notes as $note)
                <!-- TODO:  add checkmark box and trash icon -->
                <div>
                    <p>{{ $note->note }}</p>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class = "box-notes-side">
        <div class = "collection-header">
            <h2>Guides in Progress</h2>
        </div>
        <div class = "container-wrap">
            @foreach ($cards as $card)
                <x-card
                      width="full"
                      height="h-short"
                      hideType="hidden"
                      :card="$card" >
                </x-card>
            @endforeach
        </div>
    </div>
</section>

<!-- <section class = "box card-group">
    <div class = "card-group-header">
        <h2>Pockets Progress</h2>
    </div>
</section> -->

@endsection



@section('scripts')

<script>
    let count = 0;
    function runScript(e) {
        if (e.key === "Enter") {
            //e.preventDefault()
            var note = $("#note").val()
            console.log(note)
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/user-note/store') }}",
                method: "POST",
                data: { note: note },
                success: function (response) {
                    console.log("It worked!")
                    
                    let div = document.createElement("div")         // create div
                    div.id = ++count;                               // assign ID to div
                    let p = document.createElement("p")             // create p
                    p.innerHTML = note;                             // put note in p
                    
                    var notes = document.getElementById("notes")    // get #notes div
                    notes.appendChild(div);                         // append div to #notes
                    document.getElementById(count).appendChild(p)   // append p to div
                    
                    note.value = null;                              // clear note value
                }
            })
        }
    }
</script>

@endsection
