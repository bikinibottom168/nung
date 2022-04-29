@php 
if(option_get('banner_setting') == "1")
{
    $col = "col-lg-20 col-md-20 col-20";
}
elseif(option_get('banner_setting') == "2" || option_get('banner_setting') == false)
{
    $col = "col-lg-10 col-md-10 col-10";
}


@endphp

<div class="col-lg-3 col-md-4 col-4 text-left p-0">
    @foreach($ads_f1 as $k)
        @if($k->show_ads != $show_ads && $k->show_ads != 0)
            @php
                break;
            @endphp
        @endif
            <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
            @if(strrpos($k->image_ads , 'http') === false)
                <img src="{{ asset($k->image_ads) }}" alt="{{ $k->title_ads }}" class="img-fluid mb-2">
            @else
                <img src="{{ $k->image_ads }}" alt="{{ $k->title_ads }}" class="img-fluid mb-2">
            @endif
            </a>
    @endforeach
</div>
<div class="col-lg-14 col-md-12 col-12 text-center p-0">
    <div class="row">
        @foreach($ads_a as $k)
            <div class="{{ $col }} mb-2">
                @if($k->show_ads != $show_ads && $k->show_ads != 0)
                    @php
                        break;
                    @endphp
                @endif
                    @if($k->type == 1)
                    {!! $k->url_ads !!}
                    @elseif($k->type == 0)
                        <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
                        @if(strrpos($k->image_ads , 'http') === false)
                            <img src="{{ asset($k->image_ads) }}" alt="{{ $k->title_ads }}" class="img-fluid" style="width:100%">
                        @else
                            <img src="{{ $k->image_ads }}" alt="{{ $k->title_ads }}" class="img-fluid" style="width:100%">
                        @endif
                        </a>
                @endif
            </div>
        @endforeach
    </div>
</div>


<div class="col-lg-3 col-md-4 col-4 text-right p-0">
    @foreach($ads_r1 as $k)
        @if($k->show_ads != $show_ads && $k->show_ads != 0)
            @php
                break;
            @endphp
        @endif
            <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
            @if(strrpos($k->image_ads , 'http') === false)
                <img src="{{ asset($k->image_ads) }}" alt="{{ $k->title_ads }}" class="img-fluid">
            @else
                <img src="{{ $k->image_ads }}" alt="{{ $k->title_ads }}" class="img-fluid">
            @endif
            </a>
            
    @endforeach
</div>