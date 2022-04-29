
@include('template.movie.listmovie', ['title' => $title])
@include('template.ads.ads-footer')
{{ $movie->links('template.paginate') }}
