<div class="row">
    <div class="col-lg-20 col-20">
        <div class="widget" style="background-color: #f2f4f5;background: {!! option_get('primary_color') !!}">
            <div class="widget-title text-dark" >
                <p><span >ค้นหา</span></p>
            </div>
            <form action="{{ route('search') }}" method="get" class="form-row">
                <div class="col-lg-20">
                    <input type="text" name="title" class="form-control border-radius-2" placeholder="Search ...">
                </div>
                <div class="col-lg-20 mt-1">
                    <button type="submit" class="btn {{ env('SCRIPT_BUTTON_COLOR') }} btn-block btn-sm border-radius-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
          </div>
    </div>
    @if(count($ads_r2) > 0)
    <div class="col-lg-20 col-20 mt-1">
        <div class="widget" style="background-color: #f2f4f5;background: {!! option_get('primary_color') !!}">
            @foreach ($ads_r2 as $k)
                <a href="{{ $k->url_ads }}" target="_blank" >
                    <img src="{{ asset($k->image_ads) }}" alt="{{ asset($k->title_ads) }}" style="width: 100%">
                </a>
            @endforeach
        </div>
    </div>
    @endif
    <div class="col-lg-20 col-20 mt-4">
        <div class="widget" style="background-color: #f2f4f5;background: {!! option_get('primary_color') !!}">
            <div class="widget-title text-dark">
                <p><span>หมวดหมู่ <i class="fa-solid fa-clapperboard"></i></span></p>
            </div>
            <ul class="categorys" style="overflow: auto; max-height: 300px; padding-right: 5px">
                @foreach ($category as $k)
                <li class="category-item border-radius-2 text-dark">
                    <a class="text-dark d-block " href="{{ route('category', ['title' => str_replace(' ','-', $k->title_category)]) }}" title="{{ $k->title_category }} {{ $k->title_category }}">
                        {{ $k->title_category_eng }} {{ $k->title_category }}
                        <small class="float-right text-secondary my-auto">
                            ({{ $k->total }})
                        </small>
                    </a>
                </li>
                @endforeach
		    </ul>
        </div>
    </div>
    @if(env('SCRIPT_TYPE', '') == "movie" || env('SCRIPT_TYPE', '') == "anime")
        @if(count($playlist) != 0)
            <div class="col-lg-20 col-20 mt-4">
                <div class="widget" style="background-color: #f2f4f5;background: {!! option_get('primary_color') !!}">
                    <div class="widget-title text-dark">
                        <p><span>หนังไตรภาค</span></p>
                    </div>
                    <ul class="categorys" style="overflow: auto; max-height: 300px; padding-right: 5px">
                        @foreach ($playlist as $k)
                        <li class="category-item border-radius-2 text-dark">
                            <a class="text-dark d-block" href="{{ route('playlist', ['title' => $k->slug_title]) }}" title="{{ $k->title }}">
                                {{ $k->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    @endif
    <div class="col-lg-20 col-20 mt-4">
        <div class="widget" style="background-color: #f2f4f5;background: {!! option_get('primary_color') !!}">
            <div class="widget-title text-dark">
                <p><span>ปีหนัง <i class="fa-solid fa-calendar"></i></span></p>
            </div>
            <ul class="categorys mx-auto" style="overflow: auto; max-height: 300px; padding-right: 5px">
                @php $years = (int)date('Y'); @endphp
                    @for($i = $years; $i >= 1948; $i--)
                    <li class="category-item border-radius-2 text-dark" style="display: inline-block;width:45%;text-align: center">
                        <a class="text-dark d-block" href="{{ route('year',['year' => $i]) }}" >
                            {{ $i }}
                        </a>
                    </li>
                @endfor
		    </ul>
        </div>
    </div>
</div>
<style>
    hr {
        border-color: {{ env('SCRIPT_PRIMARY_COLOR') }};
        opacity: 0.4;
    }
</style>
