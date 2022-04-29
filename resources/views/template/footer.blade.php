<div class="container border-radius-1 my-5" style="background-color: {{ env('SCRIPT_PRIMARY_COLOR', '') }};background: {!! option_get('footer_color') !!}">
    <footer class="row py-2 px-2">
        <div class="col-lg-20">
            {{ $setting->footer }}
        </div>
        <div class="col-lg-10 col-20">
            <img src="{{ asset($setting->logo) }}" alt="" width="80px">
            <ul style="list-style: none;display: inline">
                {{-- <li class="text-white mr-4" style="display: inline">หน้าแรก</li>
                <li class="text-white" style="display: inline">หน้าที่ 2</li> --}}
                @foreach($menu_category as $key)
                    <li class="text-white mr-4" style="display: inline">
                        <a class="text-white" href="{{ route('category', ['title' => $key->title_category]) }}">{{ $key->title }} <span class="sr-only">(current)</span></a>
                    </li>
                @endforeach

                @foreach($menu_url as $key)
                    <li class="text-white mr-4" style="display: inline">
                        <a class="text-white" style="display: inline" href="{{ $key->description }}" target="_blank">{{ $key->title }}<span class="sr-only">(current)</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-10 col-20 text-right">
            <div id="footer-social"></div>
        </div>
    </footer>
</div>
<script>
    $(document).ready(function(){
        $("#footer-social").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["facebook","twitter"]
        });
    });
</script>