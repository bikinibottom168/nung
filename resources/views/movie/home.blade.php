@extends('master')

@section('content-top')
        @if(env('SCRIPT_TYPE', 'movie') != "movie")
        @include('template.category-word')
        @endif
        @include('template.slide')
@endsection

@section('content')
        @if(!Request::get('page'))
                <div class="col-lg-20">
                        {!! option_get('onpage_header') !!}
                </div>
        @endif
        @include('template.content-main', ['title' => option_get('title_movie') != "" ? option_get('title_movie') : "ดูหนังออนไลน์"])
        
        @if(option_get('article_home') == "1")
                @include('template.article_all', ['news' => $news, 'show_all' => true])
        @endif
@endsection

@section('content-right')
        @include('template.content-right')
        @include('template.ads.ads-right')
@endsection
