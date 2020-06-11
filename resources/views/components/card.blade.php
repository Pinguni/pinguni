<div class = "card-wrapper {{ App\Help::cardWidth($width) }}">
    <a href = "{{ App\Help::cardUrl($card) }}" target = "_blank">
        <div class = "card {{ $height ?? '' }}">
            <div class = "card-img-wrapper @if ($width == 'horizontal') {{ $height ?? '' }} @endif">
                <img class = "{{ $hideImage ?? '' }}" src = "{{ $card->thumbnail }}" />
            </div>
            <div class = "container">
                @if ($card->type === 'link')
                    <p class = "type type-teal {{ $hideType ?? '' }}"><i class = "fas fa-link"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'pocket')
                    <p class = "type type-green {{ $hideType ?? '' }}"><i class = "fas fa-envelope-open-text"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'topic')
                    <p class = "type type-purple {{ $hideType ?? '' }}"><i class = "fas fa-list-ul"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'snippet')
                    <p class = "type type-orange {{ $hideType ?? '' }}"><i class = "fas fa-sticky-note"></i>{{ $card->type }}</p>
                @elseif ($card->type === 'guide')
                    <p class = "type type-indigo {{ $hideType ?? '' }}"><i class = "fas fa-book"></i>{{ $card->type }}</p>
                @else
                    <p class = "type type-gray {{ $hideType ?? '' }}">{{ $card->type }}</p>
                @endif
                <div class = "content">
                    <p class = "title">{{ $card->title }}</p>
                    <p class = "description {{ $hideDescription ?? '' }}">{{ $card->description }}</p>
                </div>
            </div>
        </div>
    </a>
</div>