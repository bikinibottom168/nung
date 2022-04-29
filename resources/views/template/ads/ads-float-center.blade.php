@if($ads_bbb)
    <div style="z-index: 10000; position: fixed; bottom: 10px; left: 0px; right: 0px; text-align: center;" id="show_ads_c1">
        @foreach($ads_bbb as $k)
        @if($k->show_ads != $show_ads && $k->show_ads != 0)
            @php
                break;
            @endphp
        @endif
        <br>
        <div style="position: relative; display: inline-block;">
                @if(env('BANNER_BUTTON', '0') == "1")
                <div style="position: relative; top: 0%;width: 100%">
                    @if($k->button != "")
                        @php
                            $k_button = json_decode($k->button);   
                        @endphp
                        @foreach ($k_button as $kk)
                            @if($kk->status != "0")
                            <a href="{{ $kk->link }}" target="_blank" class="btn-ads btn-success" style="color: white;background-color: {{ $kk->color }}">
                                <i class="{{ $kk->icon }}" style="float: left"></i> 
                                {{ $kk->title }}
                            </a>
                            <br>
                            @endif
                        @endforeach
                    @endif
                </div>
                @endif
                <a href="javascript: document.getElementById('show_ads_c1').remove()" style="cursor: pointer; position: absolute; top: -30px; right: 0; left: 0px">
                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @if($k->type == 1)
                     {!! $k->url_ads !!}
                    @elseif($k->type == 0)
                        <a href="{{ route('ads_redirect', ['id' => $k->id]) }}" target="_blank">
                        @if(strrpos($k->image_ads , 'http') === false)
                            <img src="{{ asset($k->image_ads) }}" alt="{{ $k->title_ads }}" class="img-fluid">
                        @else
                            <img src="{{ $k->image_ads }}" alt="{{ $k->title_ads }}" class="img-fluid">
                        @endif
                    @endif
                </a>
        </div>
        @endforeach
    </div>
@endif