<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- {!! Html::script('js/jquery.js') !!} --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- {!! Html::script('js/jquery-migrate.min.js') !!} --}}
    {!! Html::script('js/jssocials.min.js') !!}
    {!! Html::script('js/owl.carousel.min.js') !!}
    {!! Html::style('css/owl.carousel.min.css') !!}
    {!! Html::style('css/owl.theme.default.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/js-social/jssocials.css') !!}
    {!! Html::style('css/js-social/jssocials-theme-flat.css') !!}
    <script src="{{ asset('js/share.js') }}"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,600" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    {{ Html::style('css/app.css') }}
 

    <title>{{ $title }}</title>
    @if(Route::is('home'))
    <link rel="canonical" href="{{ route('home') }}" />   
    <meta property="og:image" content="{{ asset($setting->logo) }}" />  
    @elseif(Route::is('movie'))
    <link rel="canonical" href="{{ route('movie', ['title' => $movie->slug_title]) }}" />
    <meta property="og:image" content="{{ asset($movie->image) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ $movie->description }}" />
    @elseif(Route::is('article'))
    <meta property="og:image" content="{{ asset($news->image) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ $title }}" />
    @elseif(\Request::is('category'))
    <link rel="canonical" href="{{ route('category', ['title' => $movie->title_eng]) }}" />
    @endif


    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />



    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $setting->keyword }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="icon" href="{{ asset($setting->icon) }}">
    
    @if(option_get("google_analytics") != false)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ option_get("google_analytics") }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', '{{ option_get("google_analytics") }}');
      </script>
    @endif

    @if(option_get("google_search") != false)
    <meta name="google-site-verification" content="{{ option_get("google_search") }}" />
    @endif
    {!! $setting->header !!}

    @foreach($ads_code as $k)
            @if($k->show_ads != $show_ads && $k->show_ads != 0)
                @php
                    break;
                @endphp
            @endif
            {!! $k->url_ads !!}
    @endforeach
    <style>
        body {
            background: {{ env("SCRIPT_BACKGROUND_COLOR", "#000") }};background: {{ option_get('bg_color') }}
        }
    </style>
    
</head>

<body>
    @yield('bg-image')
    @include('template.demo', ['text' => "รับทำเว็บดูหนังออนไลน์ อะนิเมะ เอวีJAPAN สนใจติดต่อ"])
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: {{ env('SCRIPT_PRIMARY_COLOR', '') }};background: {!! option_get('navbar_color') !!}">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->title }}" class="img-fluid" width="80px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                @foreach($menu_category as $key)
                    <li class="nav-item active">
                        <a class="nav-link text-wanning-2" href="{{ route('category', ['title' => $key->title_category]) }}" rel="{{ $key->rel }}">{{ $key->title }} </a>
                    </li>
                @endforeach

                @foreach($menu_url as $key)
                    <li class="nav-item active">
                        <a class="nav-link text-wanning-2" href="{{ $key->description }}" target="_blank" rel="{{ $key->rel }}">{{ $key->title }}</a>
                    </li>
                @endforeach

                @if(option_get('article_nav') == "1")
                    <li class="nav-item active">
                        <a class="nav-link text-wanning-2" href="{{ route('article.all') }}" target="_blank" >บทความ</a>
                    </li>
                @endif
            </ul>
            <form action="{{ route('search') }}" method="get" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 border-radius-2" name="title" type="search" placeholder="Search">
                <button class="btn {{ env('SCRIPT_BUTTON_COLOR') }} my-2 my-sm-0 border-radius-2"  type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    @include('template.ads.ads-float-left')
    @include('template.ads.ads-float-center')
    @include('template.ads.ads-float-right')

    <div class="container border-radius-1 mt-4">
        <div class="row ">
            @include('template.ads.ads-top')
        </div>
    </div>
    <div class="container bg-white border-radius-1 mt-4" style="background: {!! option_get('content_bg_color') !!}">
        <div class="row pt-4 px-2">
            @yield('content-top')
            <div class="col-lg-15 col-md-13 col-sm-12 col-20 my-4">
                @yield('content')
            </div>
            <div class="col-lg-5 col-md-7 col-sm-8 col-20 my-4">
                @yield('content-right')
            </div>
        </div>
    </div>
    @include('template.footer')
    <style>
        ::-webkit-scrollbar-thumb {
            background-color: {{ env('SCRIPT_SECONDARY_COLOR') }};
        }
        {!! option_get('css_custom') !!}
    </style>
</body>