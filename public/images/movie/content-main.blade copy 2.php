<div class="content-main">
    <div class="box" style="margin-bottom: 20px">
        <div class="box-header moviecicle" style="text-align: center; background-color: #10798e;border-radius: 4px">
            <a href="{{ route('home') }}" style="color: #fff">หนังใหม่แนะนำ</a>
        </div>
        @include('template.movie.listmovie', ['movie' => $movie_hot])
    </div>
    <div class="box">
        <div class="box-header moviecicle" style="text-align: center; background-color: #10798e;border-radius: 4px">
            <a href="{{ route('home') }}" style="color: #fff">อัพเดทล่าสุด</a>
        </div>
        @include('template.movie.listmovie', ['movie' => $movie])
    </div>
    {{-- Paginate Custom view --}}
    {{ $movie->links('template.paginate') }}
</div>
<script>
    jQuery(function($){
        $(".movie-slide").owlCarousel({
            items: 6,
        });
    });
</script>

<style>
        .movie-imdb b {
            background: url({{ asset('images/icon-star.png') }}) no-repeat 0;
            background-size: 20px 20px;
        }
</style>