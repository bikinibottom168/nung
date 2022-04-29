    @php
        if(!session()->has('locale')){
            session()->put('locale', Config::get('app.locale'));
        }
        App::setLocale(session('locale'));

        $date = Carbon\Carbon::parse($news->created_at, 'UTC');
    @endphp
    <style> #iframe-score108{ margin:0px; border: 1px solid #999; } </style>
    <div class="row">
        <div class="col-lg-20 col-20">
            <h1 class="title-header text-dark">{{ $news->title }}</h1>
        </div>
        <div class="col-lg-20 col-20">
            <p class="text-secondary" style="font-size: 0.75rem;"><i class="fas fa-user-check"></i> Admin <i class="fas fa-clock"></i> {{ $date->format('M d Y') }}</p>

            <div style="padding: 10px 20px" id="content-article">
                {!! $news->description !!}
            </div>
        </div>
    </div>
    <style>
        #content-article img{
            width: 100%;
            height: 100%;
        }

        #content-article iframe {
            width: 100%;
        }
    </style>