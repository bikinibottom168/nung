<div class="row">
    <div class="col-lg-20 col-20 my-4">
        <h1 class="title-header text-dark">{{ $title }}</h1>
    </div>
    @forelse($movie as $k)
    <div class="col-lg-4 col-md-4 col-10 my-3 centered">
        <a href="{{ option_get('movie_type') == "title" || option_get('movie_type') == false ? route('movie', ['title' => $k->slug_title]) : route('movie', ['title' => $k->id]) }}" class="item-movie">
            <div class="slide-button-play">
                <i class="far fa-play-circle" style="color: #FFBB00"></i>
            </div>
            @if(env('SCRIPT_TYPE', 'movie') == "movie")
            <div class="imdb-score text-white bg-dark p-1">
                <i class="fas fa-star text-warning"></i> {{ $k->score }}
            </div>
            <div class="resolution resolution-{{ strtolower($k->resolution) }} text-white p-2" style="background: {!! option_get('badge_color') !!}">
                {{ $k->resolution }}
            </div>
            <div class="sound-label text-white p-2" style="background: {!! option_get('badge_color') !!}">
                {{ $k->sound == "ST" ? "ซาวด์แทรค" : ($k->sound == "TH" || $k->sound == "Thai" ? "เสียงไทย" : ($k->sound == "TS" || $k->sound == "SoundTrack(T)+Thai" ? "ซาวด์แทรค": $k->sound)) }}
            </div>
            @endif
            <img src="{{ asset($k->image) }}" alt="{{ $k->title }}" class="item-poster img-fluid">
            <h2 class="title-poster text-dark mt-2">{{ $k->title }}</h2>
        </a>
    </div>
    @empty
        <div class="col-lg-20 col-20 my-4 text-center">
            <h1 class="title-header text-secondary">--ไม่พบหนัง--</h1>
        </div>
    @endforelse
</div>
