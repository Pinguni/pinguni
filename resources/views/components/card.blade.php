<div class = "card-wrapper {{ App\Help::cardWidth($width) }}">
    <a href = "{{ App\Help::cardUrl($card) }}" target = "_blank">
        
        <div class = "card {{ $height ?? '' }}">
            <div class = "container">
                @if ($card->type === 'link')
                    <p class = "type type-teal"><i class = "fas fa-link"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'pocket')
                    <p class = "type type-green"><i class = "fas fa-envelope-open-text"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'topic')
                    <p class = "type type-purple"><i class = "fas fa-list-ul"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'snippet')
                    <p class = "type type-orange"><i class = "fas fa-sticky-note"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'course')
                    <p class = "type type-indigo"><i class = "fas fa-chalkboard"></i>{{ $card->type }}</p>
                @else
                    <p class = "type type-gray">{{ $card->type }}</p>
                @endif
                <div class = "card-img-wrapper @if ($width == 'horizontal') {{ $height ?? '' }} @endif">
                    <img class = "{{ $hideImage ?? '' }}" src = "{{ $card->thumbnail }}" />
                </div>
                <div class = "content">
                    <p class = "title">{{ $card->title }}</p>
                    <p class = "description {{ $hideDescription ?? '' }}">{{ $card->description }}</p>
                </div>
            </div>
        </div>
    </a>
</div>