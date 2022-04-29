@php
if(!session()->has('locale')){
    session()->put('locale', Config::get('app.locale'));
}
App::setLocale(session('locale'));
@endphp

<div class="row">
    <div class="col-lg-16 col-10 my-auto">
        <p class="title-header text-dark">บทความ</p>
    </div>
    @if(isset($show_all))
    <div class="col-lg-4 col-10  text-right my-auto">
        <a href="{{ route('article.all') }}" class="badge badge-light">ทั้งหมด</a>
    </div>
    @endif
</div>
<div class="row">
    @foreach($news as $k)
    <div class="col-lg-5 col-md-5 col-10 my-3">
        <a href="{{ option_get('article_type') == "title" || option_get('article_type') == false ? route('article', ['title' => $k->slug_title]) : route('article', ['title' => $k->id]) }}" class="item-movie">
            <img src="{{ asset($k->image) }}" alt="{{ $k->title }}" class="item-poster img-fluid">
            <h3 class="title-poster text-dark mt-2">{{ $k->title }}</h3>
        </a>
    </div>
    @endforeach
</div>

<style>
    .item-movie:hover .item-poster{
        opacity: 0.7;
    }
    .item-poster {
        opacity: 1;
        transition: 0.5s;
    }

    .slide-button-play {
        transition: 0.3s;
        transform: scale(0);
        opacity: 0;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        margin: auto;
        width: 3rem;
        height: 3rem;
        /* line-height: 3rem; */
        border-radius: 50%;
        text-align: center;
        font-size: 2rem;
        z-index: 10;
    }
    .item-movie:hover .slide-button-play{
        opacity: 1;
        transform: scale(1);
    }

    .item-movie:hover {
        text-decoration: none;
    }
    .title-poster {
        font-size: .875rem;
        margin-bottom: 0;
        text-align: center;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
    }
    .title-header {
        font-weight: 700;
        display: inline-block;
        vertical-align: middle;
        margin-right: .5rem;
        margin-bottom: 0;
        font-size: 1.875rem;
    }
</style>