@extends('master')

@section('body')
    @php
        App::setLocale(session('locale'));
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="movie-page">
                <div class="row">

                    <div class="col-lg-12 menutop">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <a href="{{ route('collection', ['type' => 'movie']) }}">
                                    <div class="button-main" style="border: 0px solid #ff224d">
                                        @lang('site.movie')
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <a href="{{ route('collection', ['type' => 'tv']) }}">
                                    <div class="button-main" style="border: 0px solid #ff224d">
                                        @lang('site.live_tv')
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <a href="{{ route('collection', ['type' => 'series']) }}">
                                    <div class="button-main" style="border: 0px solid #ff224d">
                                        @lang('site.series')
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                <a href="{{ route('collection', ['type' => 'anime']) }}">
                                    <div class="button-main" style="border: 0px solid #ff224d">
                                        @lang('site.anime')
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                <a href="{{ route('collection', ['type' => 'av']) }}">
                                    <div class="button-main" style="border: 0px solid #ff224d">
                                        @lang('site.porn')
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="movie-title">
                            @lang('site.favorite')
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($collection as $k)
                                @php
                                    $title_temp = explode(" ", $k->title);
                                    $title_temp = implode("-", $title_temp);
                                @endphp
    
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                    <div class="movie-item" data-toggle="tooltip" data-placement="top" data-html="true" title="<h5>{{ $k->title }}</h5>">
                                        @if ($type == 'tv')
                                            @if(session()->has('smart_tv'))
                                                <a href="{{ route('tv_smart', ['id'=> $k->id,'title'=> $k->title]) }}">
                                            @else
                                                <a href="{{ route('tv', ['id'=> $k->id]) }}">
                                            @endif
                                        @else
                                            <a href="{{ route('movie', ['id'=> $k->id,'title'=> $title_temp]) }}">
                                        @endif
                                            <img class="poster" src="{{ asset($k->image) }}">
                                        </a>
                                        <a href="{{ route('member.delete.collection', ['id' => $k->id_collection, 'type' => $type ]) }}" onclick="event.preventDefault(); document.getElementById('delete-{{ $k->id_collection }}').submit();" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<h5>ลบเรื่องนี้</h5>">
                                            <img class="hd" src="{{ asset('images/collection/remove.png') }}">
                                        </a>
                                        <form action="{{ route('member.delete.collection', ['id' => $k->id_collection, 'type' => $type]) }}" method="post" id="delete-{{ $k->id_collection }}" style="display:none">
                                        {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
