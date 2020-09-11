<div class = "comments">
    <h2>Comments</h2>
    <!-- INPROGRESS:  Add add comment function -->
    @if (Auth::check())
        <input 
            id = "user_id"
            type = "hidden" 
            name = "user_id" 
            value = "{{ Auth::id() }}" />
        <input 
            id = "card_id"
            type = "hidden" 
            name = "card_id" 
            value = "{{ $cardId }}" />
        <textarea 
            id = "comment"
            name = "comment"
        ></textarea>
        <button type = "submit" onclick="addComment()">Comment</button>
    @endif
    <div id = "comments">
        @foreach ($comments as $comment)
            <div class = "comment" id = "comment-{{ $comment->id }}">
                <div>
                    <!-- TODO:  Convert user <p> to a link -->
                    <p class = "user">{{ App\User::find($comment->user_id)->username }}</p>
                    <p class = "time">{{ date('M j', strtotime($comment->created_at)) }}</p>
                </div>
                <p class = "comment">{{ $comment->comment }}</p>
                <div class = "icons">
                    @if (Auth::check() && ((Auth::id() == $comment->user_id) || (Auth::user()->role == 'admin')))
                        <a onclick = "destroyComment({{ $comment->id }})"><i class = "fas fa-trash"></i></a>
                        <!-- TODO:  Add edit button -->
                        <a onclick = ""><i class="fas fa-pen"></i></a>
                    @endif
                    <!-- TODO:  Add reply button -->
                </div>
            </div>
        @endforeach
    </div>
</div>


<script>
    let count = 0;
    let count2 = 0;
    function addComment() {
        const user_id = $("#user_id").val()
        const card_id = $("#card_id").val()
        const comment = $("#comment").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ url("/resources/comments/store") }}',
            method: "POST",
            data: { 
                user_id: user_id, 
                card_id: card_id, 
                comment: comment 
            },
            success: function (response) {                
                let div = document.createElement("div")         // create div
                div.id = ++count;

                let divInner = document.createElement("div")    // create inner div
                divInner.id = ++count2;
                let pU = document.createElement("p")            // create p.user
                pU.classList.add("user")
                //pU.innerHTML = " Auth::user()->username "
                let pT = document.createElement("p")            // create p.time
                pT.classList.add("time")
                pU.innerHTML = "{{ date('M j') }}"
                let p = document.createElement("p")             // create p.comment
                p.innerHTML = comment;

                var comments = document.getElementById("comments")      // get #comments div
                comments.prepend(div);                                  // prepend div to #comments

                document.getElementById(count).appendChild(divInner)    // append divInner to div
                document.getElementById(count).appendChild(p)           // append p to div

                document.getElementById(count2).appendChild(pU)         // append pU to divInner
                document.getElementById(count2).appendChild(pT)         // append pT to divInner
            }
        })
    }
</script>