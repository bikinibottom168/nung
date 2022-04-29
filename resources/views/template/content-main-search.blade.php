<div class="content-main">
    <div class="box">
        <h1 class="box-header">
            ค้นหา: {{ $search }}
        </h1>
        @include('template.movie.listmovie')

    </div>
    {{-- Paginate Custom view --}}
    {{ $movie->links('template.paginate', ['ads_footer'=>$ads_footer, 'show_ads' => $show_ads]) }}
</div>

<style>
        .movie-imdb b {
            background: url({{ asset('images/icon-star.png') }}) no-repeat 0;
            background-size: 11px 11px;
        }
</style>

