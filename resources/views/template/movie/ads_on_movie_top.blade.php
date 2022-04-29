<div class="row">
    @foreach ($ads_movie_top as $k)
        <div class="col-lg-20 col-20">
            <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
                <img src="{{ asset($k->image_ads) }}" width="100%" alt="{{ $k->title_ads }}" style="border: none; height: auto;">
            </a>
        </div>
    @endforeach
</div>