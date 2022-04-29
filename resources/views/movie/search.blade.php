@extends('master')

@section('content-top')
        @if(env('SCRIPT_TYPE', 'movie') != "movie")
        @include('template.category-word')
        @endif
        @include('template.slide')
@endsection

@section('content')
    @include('template.movie.listmovie', ['title' => 'ค้นหา'])
@endsection


@section('content-right')
    @include('template.content-right')
    @include('template.ads.ads-right')
@endsection