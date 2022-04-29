@foreach($ads_mt as $k)
<div class="col-lg-20 col-md-20 col-20 mb-1 text-center m-1">
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
    </div>
@endforeach