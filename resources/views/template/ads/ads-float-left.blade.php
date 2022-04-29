@if($ads_aaa)
    <div id="aaa-banner-left" style="z-index: 10000; position: fixed; bottom: 150px; left: 0; text-align: center;">
        @foreach($ads_aaa as $k)
        @if($k->show_ads != $show_ads && $k->show_ads != 0)
            @php
                break;
            @endphp
        @endif
        <br>
        <div style="position: relative; display: inline-block;">
                <a href="javascript: document.getElementById('aaa-banner-left').remove()" style="cursor: pointer; position: absolute; top: 0; right: -28px;">
                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @if($k->type == 1)
                    {!! $k->url_ads !!}
                    @elseif($k->type == 0)
                        <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
                        @if(strrpos($k->image_ads , 'http') === false)
                            <img src="{{ asset($k->image_ads) }}" alt="{{ $k->title_ads }}" width="150px">
                        @else
                            <img src="{{ $k->image_ads }}" alt="{{ $k->title_ads }}" width="150px">
                        @endif
                    @endif
                </a>
        </div>
        @endforeach
    </div>
@endif